<?php namespace Common\Auth\Controllers;

use App\User;
use Common\Auth\Actions\SendAccountConfirmationEmail;
use Common\Auth\UserRepository;
use Common\Core\BaseController;
use Common\Core\Bootstrap\BootstrapData;
use Common\Settings\Settings;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{
    use RegistersUsers;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var BootstrapData
     */
    private $bootstrapData;

    /**
     * @param Settings $settings
     * @param UserRepository $repository
     * @param BootstrapData $bootstrapData
     */
    public function __construct(Settings $settings, UserRepository $repository, BootstrapData $bootstrapData)
    {
        $this->settings = $settings;
        $this->repository = $repository;
        $this->bootstrapData = $bootstrapData;

        $this->middleware('guest');

        //abort if registration should be disabled
        if ($this->settings->get('disable.registration')) abort(404);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|max:255|confirmed',
        ];

        $this->validate($request, $rules);

        $params = $request->all();
        $needsConfirmation = $this->settings->get('require_email_confirmation');

        if ($needsConfirmation) {
            $params['confirmation_code'] = str_random(30);
            $params['confirmed'] = 0;
        }

        try {
            $user = $this->create($params);
        } catch (\Exception $e) {
            if ($e->getCode() !== 422) throw ($e);
            return $this->error(['*' => $e->getMessage()]);
        }

        if ($needsConfirmation) {
            app(SendAccountConfirmationEmail::class)->execute($user);
            return $this->success(['type' => 'confirmation_required']);
        }

        $this->guard()->login($user);

        return $this->registered($request, $user);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * The user has been registered.
     *
     * @param Request $request
     * @param $user
     *
     * @return JsonResponse
     */
    protected function registered(Request $request, User $user)
    {
        $data = $this->bootstrapData->init()->getEncoded();
        return $this->success(['data' => $data]);
    }
}
