<?php

namespace TrainjunkiesPackages\QueueSubscriber\NationalRail;

use TrainjunkiesPackages\QueueSubscriber\Queue\Message;
use TrainjunkiesPackages\QueueSubscriber\Queue\MessageAbstract;

class PushPortMessage extends MessageAbstract implements Message
{
    public function ack(callable $callback, $timeout = 0)
    {
        $function = function ($body, $headers) use ($callback) {
            $callback(
                gzdecode($body),
                $headers
            );
        };

        $this->read($function, $timeout);
    }
}
