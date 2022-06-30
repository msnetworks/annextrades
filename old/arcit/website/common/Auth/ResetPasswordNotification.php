<?php namespace Common\Auth;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as LaravelResetPasswordNotification;

class ResetPassword extends LaravelResetPasswordNotification
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('Reset Password'))
            ->line(__('You are receiving this email because you have requested a password reset for your account.'))
            ->action(__('Reset Password'), url("password/reset/$this->token"))
            ->line(__('If you did not request a password reset, no further action is required.'));
    }
}
