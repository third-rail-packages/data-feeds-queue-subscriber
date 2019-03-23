<?php

namespace TrainjunkiesPackages\QueueSubscriber\NationalRail;

use TrainjunkiesPackages\QueueSubscriber\Queue\ContextFactory;
use TrainjunkiesPackages\QueueSubscriber\Queue\Subscriber;
use TrainjunkiesPackages\QueueSubscriber\Queue\TopicSubscriber;

class QueueFactory
{
    public static function create($username, $password, $host, $port = 61613)
    {
        return new TopicSubscriber(
            ContextFactory::create(
                $username,
                $password,
                $host,
                $port
            )
        );
    }
}
