<?php

namespace TrainjunkiesPackages\QueueSubscriber\NetworkRail;

use TrainjunkiesPackages\QueueSubscriber\Queue\ContextFactory;
use TrainjunkiesPackages\QueueSubscriber\Queue\TopicSubscriber;

class QueueFactory
{
    public static function create($username, $password)
    {
        return new TopicSubscriber(
            ContextFactory::create(
                $username,
                $password,
                'datafeeds.networkrail.co.uk',
                61618
            )
        );
    }
}
