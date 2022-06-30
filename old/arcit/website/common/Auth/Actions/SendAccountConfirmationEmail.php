<?php

namespace Common\Auth\Actions;

use App\User;
use Common\Mail\ConfirmEmail;
use Common\Settings\Settings;
use Mail;

class SendAccountConfirmationEmail
{
    /**
     * @var Settings
     */
    private $settings;

    /**
     * @param Settings $settings
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param User $user
     */
    public function execute(User $user)
    {
        if ( ! $user->confirmed && $this->settings->get('require_email_confirmation')) {
            if ( ! $user->confirmation_code) {
                $user->confirmation_code = str_random(30);
                $user->save();
            }
            Mail::queue(new ConfirmEmail($user->email, $user->confirmation_code));
        }
    }
}
