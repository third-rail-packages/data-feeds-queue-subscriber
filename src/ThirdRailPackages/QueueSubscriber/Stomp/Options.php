<?php

namespace ThirdRailPackages\QueueSubscriber\Stomp;

class Options
{
    /** @var string */
    private $host = '';
    /** @var string */
    private $port = '';
    /** @var string */
    private $username = '';
    /** @var string */
    private $password = '';
    /** @var string */
    private $clientId = '';
    /** @var string */
    private $subscriptionName = '';
    /** @var int */
    private $readTimeout = DefaultTimeouts::READ_TIMEOUT;
    /** @var int */
    private $heartbeatReadTimeout = DefaultTimeouts::HEARTBEAT_READ;

    private function __construct(OptionsBuilder $builder)
    {
        $this->host = $builder->host;
        $this->port = $builder->port;
        $this->username = $builder->username;
        $this->password = $builder->password;
        $this->clientId = $builder->clientId;
        $this->subscriptionName = $builder->subscriptionName;
        $this->readTimeout = $builder->readTimeout;
        $this->heartbeatReadTimeout = $builder->heartbeatReadTimeout;
    }

    /**
     * @param OptionsBuilder $builder
     *
     * @return Options
     */
    public static function fromBuilder(OptionsBuilder $builder)
    {
        return new self($builder);
    }

    public function host(): string
    {
        return $this->host;
    }

    public function port(): string
    {
        return $this->port;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function clientId(): string
    {
        return $this->clientId;
    }

    public function subscriptionName(): string
    {
        return $this->subscriptionName;
    }

    public function readTimeout(): int
    {
        return $this->readTimeout;
    }

    public function heartbeatReadTimeout(): int
    {
        return $this->heartbeatReadTimeout;
    }
}
