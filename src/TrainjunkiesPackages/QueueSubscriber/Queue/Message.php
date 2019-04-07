<?php

namespace TrainjunkiesPackages\QueueSubscriber\Queue;

use Enqueue\Stomp\StompConsumer;

interface Message
{
    /**
     * @param StompConsumer $consumer
     *
     * @return $this
     */
    public function setConsumer(StompConsumer $consumer);

    /**
     * @param callable $callback
     * @param int      $timeout
     *
     * @return mixed
     */
    public function ack(callable $callback, $timeout = 0);
}
