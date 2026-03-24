<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\URL;

class AdminResetPasswordNotification extends ResetPassword
{
    /**
     * Build the password reset URL for the admin.
     */
    protected function resetUrl($notifiable)
    {
        return URL::route('admin.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);
    }
}
