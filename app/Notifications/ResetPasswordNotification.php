<?php

namespace App\Notifications;
use Illuminate\Auth\Notifications\ResetPassword;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{  

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
        ->subject('Youcons - redefinição de senha')
        ->view('vendor.notifications.email', ['actionUrl' => url( config('app.url').route('password.reset', $this->token, false) ) ] );    
    }
 
}
