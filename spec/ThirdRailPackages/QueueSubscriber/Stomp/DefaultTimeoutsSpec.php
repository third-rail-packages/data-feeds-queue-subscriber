<?php

namespace spec\ThirdRailPackages\QueueSubscriber\Stomp;

use ThirdRailPackages\QueueSubscriber\Stomp\DefaultTimeouts;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DefaultTimeoutsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DefaultTimeouts::class);
    }
}
