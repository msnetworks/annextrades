<?php

namespace Common\Core;

use App\User;
use Auth;
use Common\Core\Policies\AuthorizationException as AppAuthorizationException;
use Common\Notifications\ErrorNotification;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Swift_TransportException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseExceptionHandler extends Handler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception) && config('app.env') === 'production') {
            if ($user = Auth::user()) {
                app('sentry')->set_user_data($user->id, $user->email, $user->toArray());
            }
            app('sentry')->captureException($exception);
        }

        if ($exception instanceof Swift_TransportException) {
            app(User::class)->findAdmin()->notify(new ErrorNotification([
                'warning' => true,
                'mainAction' => [
                    'label' => 'Open help center article',
                    'action' => 'https://support.vebto.com/help-center/articles/42/44/76/configuring-email-provider',
                ],
                'lines' => [
                    ['content' => 'There was an issue with sending out an email.'],
                    ['content' => 'Did you configure your mail provider from settings page?', 'action' => [
                        'label' => 'Open settings',
                        'action' => '/admin/settings/mail',
                    ]],
                ],
            ]));
            return;
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Exception $exception
     * @return JsonResponse|Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof AuthorizationException && Auth::guest()) {
            return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof AppAuthorizationException && $request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'messages' => ['general' => $exception->getMessage()],
                'showUpgradeButton' => $exception->showUpgradeButton,
            ], 403);
        }

        //TODO: show some kind of error modal on frontend similar to current laravel whoops screen
//        if (config('app.env') === 'production' && config('app.debug') && $request->expectsJson()) {
//            return response()->json(['messages' => ['*' => $exception->getMessage()]], 500);
//        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  Request  $request
     * @param AuthenticationException|AuthorizationException $exception
     * @return JsonResponse|RedirectResponse
     */
    protected function unauthenticated($request, $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['messages' => ['*' => 'Unauthenticated.']], 403);
        }

        return redirect()->guest('login');
    }
}
