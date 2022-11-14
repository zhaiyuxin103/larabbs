<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use JPush\Client;

class JPushChannel
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function send($notifiable, Notification $notification): void
    {
        $notification->toJPush($notifiable, $this->client->push())->send();
    }
}
