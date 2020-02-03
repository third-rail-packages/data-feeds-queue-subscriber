<?php

namespace TrainjunkiesPackages\QueueSubscriber;

use Stomp\Client as StompClient;
use Stomp\Network\Connection as StompConnection;
use Stomp\StatefulStomp;
use TrainjunkiesPackages\QueueSubscriber\Stomp\Exception\ConnectionException;
use TrainjunkiesPackages\QueueSubscriber\Stomp\Options;

class Client
{
    /**
     * @var Options
     */
    private $options;
    /**
     * @var StompClient
     */
    private $stompClient;
    /**
     * @var StatefulStomp
     */
    private $stompSubscription;

    public function __construct(Options $options)
    {
        $this->options = $options;

        $this->hasStompHostAndPort();

        $this->stompClient = $this->registerStompClient();

        // refactor to decorator
        $this->decorateStompClient();

        $this->stompSubscription = $this->registerStompSubscription();
    }

    public function stompClient(): StompClient
    {
        return $this->stompClient;
    }

    public function subscription(): StatefulStomp
    {
        return $this->stompSubscription;
    }

    public function options(): Options
    {
        return $this->options;
    }

    private function hasStompHostAndPort(): void
    {
        if (empty($this->options->host()) || empty($this->options->port())) {
            throw ConnectionException::missingHostOrPort($this->options);
        }
    }

    /**
     * @return StompClient
     * @throws \Stomp\Exception\ConnectionException
     */
    protected function registerStompClient(): StompClient
    {
        return new StompClient(
            new StompConnection(
                sprintf(
                    "tcp://%s:%s",
                    $this->options->host(),
                    $this->options->port()
                )
            )
        );
    }

    private function registerStompSubscription(): StatefulStomp
    {
        return new StatefulStomp(
            $this->stompClient
        );
    }

    private function decorateStompClient(): void
    {
        $this->bindAuthentication();
        $this->bindClientId();
    }

    private function bindClientId(): void
    {
        if (!empty($this->options->clientId())) {
            $this->stompClient->setClientId(
                $this->options->clientId()
            );
        }
    }

    private function bindAuthentication(): void
    {
        if (!empty($this->options->username()) &&
            !empty($this->options->password())
        ) {
            $this->stompClient->setLogin(
                $this->options->username(),
                $this->options->password()
            );
        }
    }
}
