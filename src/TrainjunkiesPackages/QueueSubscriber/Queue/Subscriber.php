<?php

namespace TrainjunkiesPackages\QueueSubscriber\Queue;

use Enqueue\Stomp\StompContext;

class Subscriber
{
    /**
     * @var StompContext
     */
    private $context;

    public function __construct(StompContext $context)
    {
        $this->context = $context;
    }

    public function consume($queue, callable $callback)
    {
        $destination = $this->context->createQueue($queue);
        $destination->setDurable(true);
        $destination->setAutoDelete(false);
        $consumer = $this->context->createConsumer($destination);

        while (true) {
            if ($message = $consumer->receive()) {
                $body = gzdecode($message->getBody());
                $callback($body);
                $consumer->acknowledge($message);
            }
        }
    }
}
