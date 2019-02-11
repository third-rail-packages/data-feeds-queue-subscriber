<?php

namespace TrainjunkiesPackages\QueueSubscriber\Queue;

use Enqueue\Stomp\StompContext;

class TopicSubscriber
{
    /**
     * @var StompContext
     */
    private $context;

    public function __construct(StompContext $context)
    {
        $this->context = $context;
    }

    public function consume($topic, callable $callback)
    {
        $destination = $this->context->createTopic('/topic/' . $topic);
        $destination->setDurable(true);
        $destination->setAutoDelete(false);
        $consumer = $this->context->createConsumer($destination);

        while (true) {
            if ($message = $consumer->receive()) {
                $callback($message->getBody());
                $consumer->acknowledge($message);
            }
        }
    }
}
