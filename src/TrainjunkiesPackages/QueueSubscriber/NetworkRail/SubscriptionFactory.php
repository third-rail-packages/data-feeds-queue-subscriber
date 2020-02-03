<?php

namespace TrainjunkiesPackages\QueueSubscriber\NetworkRail;

use TrainjunkiesPackages\QueueSubscriber\Client;
use TrainjunkiesPackages\QueueSubscriber\Stomp\OptionsBuilder;
use TrainjunkiesPackages\QueueSubscriber\Stomp\SubscriberInterface;
use TrainjunkiesPackages\QueueSubscriber\Stomp\Subscription;

class SubscriptionFactory
{
    public static function create(
        string $username,
        string $password,
        string $host = 'datafeeds.networkrail.co.uk',
        string $port = '61618'
    ): SubscriberInterface {
        $options = (new OptionsBuilder())
            ->withUsername($username)
            ->withPassword($password)
            ->withHost($host)
            ->withPort($port)
            ->build();

        return new Subscription(
            new Client($options)
        );
    }
}
