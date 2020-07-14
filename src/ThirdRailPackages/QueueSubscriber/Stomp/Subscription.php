<?php

namespace ThirdRailPackages\QueueSubscriber\Stomp;

class Subscription extends SubscriberAbstract implements SubscriberInterface
{
    public function consume(string $queue, callable $callback): void
    {
        $this->subscribe($queue);

        $this->loop(function () use ($callback) {
            if ($frame = $this->read()) {
                $callback(new Message($frame));
            }
        });
    }

    protected function subscribe($destination): void
    {
        $this->client->subscription()->subscribe($destination);
    }
}
