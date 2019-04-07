<?php

namespace TrainjunkiesPackages\QueueSubscriber\Queue;

use Enqueue\Stomp\StompConsumer;

abstract class MessageAbstract
{
    /**
     * @var StompConsumer
     */
    private $consumer;

    public function setConsumer(StompConsumer $consumer)
    {
        $this->consumer = $consumer;

        return $this;
    }

    protected function read(callable $callback, $timeout = 0)
    {
        while (true) {
            if ($message = $this->consumer->receive($timeout)) {
                $callback(
                    $message->getBody(),
                    $message->getHeaders()
                );
                $this->consumer->acknowledge($message);
            }
        }
    }
}
