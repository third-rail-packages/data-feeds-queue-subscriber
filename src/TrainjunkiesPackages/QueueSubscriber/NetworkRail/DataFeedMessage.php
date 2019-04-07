<?php

namespace TrainjunkiesPackages\QueueSubscriber\NetworkRail;

use TrainjunkiesPackages\QueueSubscriber\Queue\Message;
use TrainjunkiesPackages\QueueSubscriber\Queue\MessageAbstract;

class DataFeedMessage
    extends MessageAbstract
    implements Message
{
    public function ack(callable $callback, $timeout = 0)
    {
        $this->read($callback, $timeout);
    }
}
