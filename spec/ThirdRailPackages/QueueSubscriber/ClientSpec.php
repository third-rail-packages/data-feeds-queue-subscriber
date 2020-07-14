<?php

namespace spec\ThirdRailPackages\QueueSubscriber;

use Stomp\Client as StompClient;
use Stomp\StatefulStomp;
use ThirdRailPackages\QueueSubscriber\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ThirdRailPackages\QueueSubscriber\Stomp\Exception\ConnectionException;
use ThirdRailPackages\QueueSubscriber\Stomp\OptionsBuilder;

class ClientSpec extends ObjectBehavior
{
    const BROKER = 'activemq';
    const PORT = '61613';
    const USERNAME = 'user';
    const PASSWORD = 'Pa$$W0r6?';

    function let()
    {
        $options = (new OptionsBuilder)
            ->withHost(self::BROKER)
            ->withPort(self::PORT)
            ->build();

        $this->beConstructedWith($options);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }

    function it_can_throw_exception_for_empty_host()
    {
        $options = (new OptionsBuilder)
            ->withPort(self::PORT)
            ->build();

        $this->beConstructedWith($options);

        $this->shouldThrow(ConnectionException::class)
            ->duringInstantiation();
    }

    function it_can_throw_exception_for_empty_port()
    {
        $options = (new OptionsBuilder)
            ->withHost('activemq')
            ->build();

        $this->beConstructedWith($options);

        $this->shouldThrow(ConnectionException::class)
            ->duringInstantiation();
    }

    function it_can_throw_exception_for_empty_uri()
    {
        $options = (new OptionsBuilder)->build();

        $this->beConstructedWith($options);

        $this->shouldThrow(ConnectionException::class)
            ->duringInstantiation();
    }

    function it_can_bind_authentication()
    {
        $options = (new OptionsBuilder)
            ->withHost(self::BROKER)
            ->withPort(self::PORT)
            ->withUsername(self::USERNAME)
            ->withPassword(self::PASSWORD)
            ->build();

        $this->beConstructedWith($options);

    }

    function it_has_stateful_stomp_client()
    {
        $this->stompClient()->shouldBeAnInstanceOf(StompClient::class);
    }

    public function it_can_connect_to_stomp_broker()
    {
        $this->subscription()->shouldBeAnInstanceOf(StatefulStomp::class);
    }
}
