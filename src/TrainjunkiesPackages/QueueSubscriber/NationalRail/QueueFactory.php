<?php

namespace TrainjunkiesPackages\QueueSubscriber\NationalRail;

use TrainjunkiesPackages\QueueSubscriber\Queue\ContextFactory;
use TrainjunkiesPackages\QueueSubscriber\Queue\TopicConsumer;

class QueueFactory
{
    public static function create($username, $password, $host, $port = 61613)
    {
        return new TopicConsumer(
            ContextFactory::create(
                $username,
                $password,
                $host,
                $port
            ),
            new PushPortMessage
        );
    }
}
