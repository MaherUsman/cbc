<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    private $verification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $verification)
    {
        $this->verification = $verification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verification = $this->verification->otp; // Assuming $this->otp->otp contains the OTP code
        $email = $this->verification->email;
        return (new MailMessage)
            ->subject('Reset Password')
            ->line('You are receiving this email because we received a reset password request from your account.')
//            ->line(new HtmlString('Your OTP Code is: <strong>'.$verification.'</strong> '))
//            ->action('Reset Password', url('/forgot-request?email='.$email.'&otp='.$verification)) // OTP verification link
            ->action('Reset Password', url('/reset?email='.$email.'&otp='.$verification)) // OTP verification link
            ->line('If you did not request this, no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
