<?php

namespace TrainjunkiesPackages\QueueSubscriber\Queue;

use Enqueue\Stomp\StompContext;

class TopicConsumer
{
    /**
     * @var StompContext
     */
    private $context;
    /**
     * @var Message
     */
    private $message;

    public function __construct(StompContext $context, Message $message)
    {
        $this->context = $context;
        $this->message = $message;
    }

    /**
     * @param      $topic
     * @param bool $durable
     * @param bool $autoDelete
     *
     * @return Message
     */
    public function consumer($topic, $durable = true, $autoDelete = false)
    {
        $destination = $this->context->createTopic('/topic/' . $topic);
        $destination->setDurable($durable);
        $destination->setAutoDelete($autoDelete);

        return $this->message->setConsumer(
            $this->context->createConsumer($destination)
        );
    }
}
