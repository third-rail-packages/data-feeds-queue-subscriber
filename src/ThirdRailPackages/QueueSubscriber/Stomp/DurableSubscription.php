<?php

namespace ThirdRailPackages\QueueSubscriber\Stomp;

use Stomp\Network\Observer\ConnectionObserver;
use Stomp\Network\Observer\ServerAliveObserver;
use ThirdRailPackages\QueueSubscriber\Client;
use ThirdRailPackages\QueueSubscriber\Stomp\Exception\HeartbeatException;

class DurableSubscription extends SubscriberAbstract implements SubscriberInterface
{
    /**
     * @var ServerAliveObserver
     */
    private $heartbeatObserver;

    public function __construct(
        Client $client,
        ServerAliveObserver $heartbeatObserver
    ) {
        parent::__construct($client);

        $this->heartbeatObserver = $heartbeatObserver;
    }

    public function consume(string $queue, callable $callback): void
    {
        $this->setupHeartbeat($this->heartbeatObserver);

        $this->subscribe($queue);

        $this->heartbeatsEnabled();

        $this->loop(function () use ($callback) {
            $this->heartbeatObserver->isDelayed();

            if ($frame = $this->read()) {
                $callback(new Message($frame));
                $this->ack($frame);
            }
        });
    }

    protected function subscribe($destination): void
    {
        $this->client->subscription()->subscribe(
            $destination,
            null,
            'client-individual',
            $this->subscriptionNameHeader()
        );
    }

    private function setupHeartbeat(
        ConnectionObserver $observer
    ): void {
        $this->client
            ->stompClient()
            ->getConnection()
            ->setReadTimeout($this->client->options()->readTimeout());

        $this->client->stompClient()->setHeartbeat(
            0, // We are not sending beats to the broker
            $this->client->options()->heartbeatReadTimeout()
        );

        $this->client
            ->stompClient()
            ->getConnection()
            ->getObservers()
            ->addObserver($observer);
    }

    /**
     * @return array<string>
     */
    private function subscriptionNameHeader(): array
    {
        return [
            'activemq.subscriptionName' => $this->client
                ->options()->subscriptionName()
        ];
    }

    private function heartbeatsEnabled(): void
    {
        if (!$this->heartbeatObserver->isEnabled()) {
            throw HeartbeatException::heartbeatNotEnabled();
        }
    }
}
