<?php

namespace spec\ThirdRailPackages\QueueSubscriber\Stomp;

use PhpSpec\ObjectBehavior;
use ThirdRailPackages\QueueSubscriber\Stomp\StompClientFactory;

class StompClientFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StompClientFactory::class);
    }
}
