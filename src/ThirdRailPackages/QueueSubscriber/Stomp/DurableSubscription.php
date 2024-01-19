<?php

namespace ThirdRailPackages\QueueSubscriber\Stomp;

use Exception;
use Stomp\Broker\ActiveMq\Mode\DurableSubscription as StompDurableSubscription;
use Stomp\Client;
use Throwable;

class DurableSubscription
{
    public bool $looping = false;

    public function __construct(private readonly Client $client, private readonly string $subscriptionId)
    {
    }

    public function consume(string $topic, callable $callback): void
    {
        $durableConsumer = new StompDurableSubscription(
            $this->client,
            $topic,
            null,
            'client',
            $this->subscriptionId
        );
        $durableConsumer->activate();

        $this->looping = true;

        while ($this->looping) { // @phpstan-ignore-line
            try {
                if ($frame = $durableConsumer->read()) {
                    $callback(new Message($frame));
                    $durableConsumer->ack($frame);
                }

                if (!$durableConsumer->isActive()) {
                    $this->looping = false;

                    throw new Exception('Consumer no longer active');
                }
            } catch (Throwable $t) {
                $this->looping = false;

                throw $t;
            }
        }
    }
}
