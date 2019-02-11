<?php

namespace TrainjunkiesPackages\QueueSubscriber\NationalRail;

use TrainjunkiesPackages\QueueSubscriber\Queue\ContextFactory;
use TrainjunkiesPackages\QueueSubscriber\Queue\Subscriber;

class QueueFactory
{
    public static function create($username, $password)
    {
        return new Subscriber(
            ContextFactory::create(
                $username,
                $password,
                'datafeeds.nationalrail.co.uk',
                61613
            )
        );
    }
}
