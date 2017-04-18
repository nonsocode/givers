<?php
namespace App\Notifications;

use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioCallMessage;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [TwilioChannel::class];
    }

    public function toTwilio($notifiable)
    {
    	dd('sup');
        return (new TwilioSmsMessage())
            ->content("Your {$notifiable->service} account was approved!");
    }

    public function routeNotificationForTwilio()
	{
		dd($this);
	    return '+2347012903451';
	}
}