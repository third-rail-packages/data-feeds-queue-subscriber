<?php

namespace TrainjunkiesPackages\QueueSubscriber\NetworkRail;

use TrainjunkiesPackages\QueueSubscriber\Queue\ContextFactory;
use TrainjunkiesPackages\QueueSubscriber\Queue\TopicConsumer;

class QueueFactory
{
    public static function create(
        $username,
        $password,
        $host = 'datafeeds.networkrail.co.uk',
        $port = 61618
    ) {
        return new TopicConsumer(
            ContextFactory::create(
                $username,
                $password,
                $host,
                $port
            ),
            new DataFeedMessage
        );
    }
}
