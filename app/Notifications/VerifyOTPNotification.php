<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class VerifyOTPNotification extends Notification
{
    use Queueable;

    /**
     * @var User
     */
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
//        $fromAddress = 'signup@probackingtracks.co';
//        $fromName = config('APP_NAME')?:'HoubaraFund (CBC)';
        $verification = $this->verification->otp; // Assuming $this->otp->otp contains the OTP code

        return (new MailMessage)
            ->subject('Email Verification')
//            ->from($fromAddress, $fromName)
            ->line('You are receiving this email because we received a signup request from your account.')
            ->action('Verify Email', url('/verify?otp='.$verification))
            ->line('If you have not requested this signup, no further action is required.');
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
