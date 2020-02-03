<?php

namespace TrainjunkiesPackages\QueueSubscriber\Stomp;

interface SubscriberInterface
{
    public function consume(string $queue, callable $callback) : void;
}
