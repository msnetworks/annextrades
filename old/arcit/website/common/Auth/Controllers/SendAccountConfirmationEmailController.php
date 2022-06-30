<?php

namespace Common\Auth\Controllers;

use App\User;
use Common\Auth\Actions\SendAccountConfirmationEmail;
use Common\Core\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SendAccountConfirmationEmailController extends BaseController
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param User $user
     * @param Request $request
     */
    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * @return JsonResponse
     */
    public function send()
    {
        $user = $this->user->where('email', $this->request->get('email'))->firstOrFail();

        app(SendAccountConfirmationEmail::class)->execute($user);

        return $this->success();
    }
}
