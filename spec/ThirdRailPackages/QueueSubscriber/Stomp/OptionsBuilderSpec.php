<?php

namespace spec\ThirdRailPackages\QueueSubscriber\Stomp;

use ThirdRailPackages\QueueSubscriber\Stomp\OptionsBuilder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OptionsBuilderSpec extends ObjectBehavior
{
    const HOST = 'datafeeds.networkrail.co.uk';
    const PORT = '61613';
    const USERNAME = 'email@example.com';
    const PASSWORD = 'Pa$$W0r6_!';
    const CLIENT_ID = 'client-id';
    const SUBSCRIPTION_NAME = self::USERNAME;
    const READ_TIMEOUT = 12;
    const HEARTBEAT_TIMEOUT = 20000;

    function it_is_initializable()
    {
        $this->shouldHaveType(OptionsBuilder::class);
    }

    function it_has_host()
    {
        $this->withHost(self::HOST)->build()->host()->shouldBe(self::HOST);
        $this->withPort(self::PORT)->build()->port()->shouldBe(self::PORT);
        $this->withUsername(self::USERNAME)->build()->username()->shouldBe(self::USERNAME);
        $this->withPassword(self::PASSWORD)->build()->password()->shouldBe(self::PASSWORD);
        $this->withClientId(self::CLIENT_ID)->build()->clientId()->shouldBe(self::CLIENT_ID);
        $this->withSubscriptionName(self::SUBSCRIPTION_NAME)->build()->subscriptionName()->shouldBe(self::SUBSCRIPTION_NAME);
        $this->withReadTimeout(self::READ_TIMEOUT)->build()->readTimeout()->shouldBe(self::READ_TIMEOUT);
        $this->withHeartbeatReadTimeout(self::HEARTBEAT_TIMEOUT)->build()->heartbeatReadTimeout()->shouldBe(self::HEARTBEAT_TIMEOUT);
    }

    function it_has_default_timeouts()
    {
        $this->build()->readTimeout()->shouldBe(5);
        $this->build()->heartbeatReadTimeout()->shouldBe(15000);
    }
}
