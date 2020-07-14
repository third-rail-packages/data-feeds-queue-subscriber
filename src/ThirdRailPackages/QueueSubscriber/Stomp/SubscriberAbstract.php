<?php

namespace ThirdRailPackages\QueueSubscriber\Stomp;

use Stomp\Transport\Frame;
use ThirdRailPackages\QueueSubscriber\Client;

abstract class SubscriberAbstract
{
    /** @var bool */
    public $loopRunning = true;

    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Subscribe to destination and
     * infinitely consume messages
     *
     * @param string $destination
     */
    abstract protected function subscribe($destination): void;

    /**
     * @return false|Frame
     */
    public function read()
    {
        return $this->client->subscription()->read();
    }

    public function ack(Frame $frame): void
    {
        $this->client->subscription()->ack($frame);
    }

    /**
     * @param Frame     $frame
     * @param null|bool $requeue
     */
    public function nack(Frame $frame, $requeue = null): void
    {
        $this->client->subscription()->nack($frame, $requeue);
    }

    /**
     * @param callable $callback
     */
    protected function loop(callable $callback): void
    {
        while ($this->loopRunning) {
            $callback();
        }
    }
}
