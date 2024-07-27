<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class FcmNotificationsService
{
    protected string $FCM_KEY;

    public function __construct()
    {
        $this->FCM_KEY = ENV('FIREBASE_FCM_KEY');
    }

    private function getHeaders(): array
    {
        return [
            'Authorization' => 'key='.$this->FCM_KEY,
            'Content-Type' => 'application/json',
        ];
    }

    private function getNotificationData($data): array
    {
        return [
            'title' => $data['title'],
            'body' => $data['body'],
            'content-available' => 1,
            'sound' => 'default',
            'type_id' => 1,
        ];
    }

    /**
     * @throws GuzzleException
     */
    private function sendRequestToFcm($body): void
    {
        $client = new Client(['headers' => $this->getHeaders()]);
        $client->post('https://fcm.googleapis.com/fcm/send', [
            'body' => json_encode($body),
        ]);
    }

    /**
     * @throws GuzzleException
     */
    private function sendToMoreToken($tokens, $details): void
    {
        $body = [
            'data' => $this->getNotificationData($details),
            'notification' => $this->getNotificationData($details),
            'registration_ids' => $tokens ?? [],
        ];
        $this->sendRequestToFcm($body);
    }

    /**
     * @throws GuzzleException
     */
    private function sendToOneToken($token, $details): void
    {
        $body = [
            'data' => $this->getNotificationData($details),
            'notification' => $this->getNotificationData($details),
            'to' => $token,
        ];
        $this->sendRequestToFcm($body);
    }

    /**
     * @throws GuzzleException
     */
    public function sendToUsers($users, $title, $notification, $body): void
    {
        $details = [
            'title' => $title, 'body' => $body,
        ];
        foreach ($users as $user) {
            $tokens = $user->fcmTokens()?->get()->pluck('fcm_token')->toArray();

            $user->notify(new $notification($details));
            $this->sendToMoreToken($tokens, $details);
        }
    }

    /**
     * @throws GuzzleException
     */
    public function sendToUser($user, $title, $notification, $body): void
    {
        $details = [
            'title' => $title, 'body' => $body,
        ];

        $user->notify(new $notification($details));
        $tokens = $user->fcmTokens()?->get()->pluck('fcm_token')->toArray();
        $this->sendToMoreToken($tokens, $details);
    }
}
