<?php

namespace spec\ThirdRailPackages\QueueSubscriber\Stomp;

use PhpSpec\ObjectBehavior;
use Stomp\Client;
use ThirdRailPackages\QueueSubscriber\Stomp\DurableSubscription;

class DurableSubscriptionSpec extends ObjectBehavior
{
    const FAKE_SUB = 'FAKE-SUB';

    function let(Client $client)
    {
        $this->beConstructedWith($client, self::FAKE_SUB);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DurableSubscription::class);
    }
}
