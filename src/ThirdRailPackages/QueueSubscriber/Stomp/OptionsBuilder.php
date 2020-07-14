<?php

namespace ThirdRailPackages\QueueSubscriber\Stomp;

class OptionsBuilder
{
    /** @var string */
    public $host = '';
    /** @var string */
    public $port = '';
    /** @var string */
    public $username = '';
    /** @var string */
    public $password = '';
    /** @var string */
    public $clientId = '';
    /** @var string */
    public $subscriptionName = '';
    /** @var int */
    public $readTimeout = DefaultTimeouts::READ_TIMEOUT;
    /** @var int */
    public $heartbeatReadTimeout = DefaultTimeouts::HEARTBEAT_READ;

    public function withHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function withPort(string $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function withUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function withPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Used when connecting to broker.
     * This should be the username you
     * connect to NationalRail / Network Rail
     * with
     *
     * @param string $clientId
     *
     * @return OptionsBuilder
     */
    public function withClientId(string $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * activemq.subscriptionName header value
     * sent during subscribing. This should be a unique
     * value on the environment and feed you are consuming
     *
     * @param string $subscriptionName
     *
     * @return OptionsBuilder
     */
    public function withSubscriptionName(string $subscriptionName): self
    {
        $this->subscriptionName = $subscriptionName;

        return $this;
    }

    public function withReadTimeout(int $timeout): self
    {
        $this->readTimeout = $timeout;

        return $this;
    }

    public function withHeartbeatReadTimeout(int $heartbeat): self
    {
        $this->heartbeatReadTimeout = $heartbeat;

        return $this;
    }

    /**
     * @return Options
     */
    public function build()
    {
        return Options::fromBuilder($this);
    }
}
