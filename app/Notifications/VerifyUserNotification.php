<?php


namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyUserNotification extends Notification
{
    use Queueable;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = route('userVerification', $this->user->verification_token);

        return (new MailMessage())
            ->subject('Account Verification')
            ->markdown('auth.verify_user', ['user' => $this->user, 'url' => $url]);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
