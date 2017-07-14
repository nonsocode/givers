<?php 

namespace App\Notifications;

use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [TwilioChannel::class];
    }

    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage())
            ->content("Your {$notifiable->service} account was approved!");
    }
}