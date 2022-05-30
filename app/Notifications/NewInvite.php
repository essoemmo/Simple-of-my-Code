<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

class NewInvite extends Notification
{
    use Queueable;

    private $details;

    public function __construct($details)
    {
        $this->details = $details;
    }
    
    public function via($notifiable)
    {
        return [FcmChannel::class,'database'];
    }

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData(['data1' => 'value', 'data2' => 'value2'])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle($this->details['title_'. app()->getLocale()])
                ->setBody($this->details['body_'. app()->getLocale()])
                ->setImage(url('/notify/accept_invite.png')))
            ->setAndroid(
                AndroidConfig::create()
                ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
            )->setApns(
                ApnsConfig::create()
                ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));
    }

    public function toDatabase()
    {
        return [
                'title_en'=> $this->details['title_en'],
                'body_en' => $this->details['body_en'],
                'title_ar'=> $this->details['title_ar'],
                'body_ar' => $this->details['body_ar'],
                'image'   => url('/notify/accept_invite.png'),
        ];
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
