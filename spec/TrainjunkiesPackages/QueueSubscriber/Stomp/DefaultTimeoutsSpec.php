<?php

namespace spec\TrainjunkiesPackages\QueueSubscriber\Stomp;

use TrainjunkiesPackages\QueueSubscriber\Stomp\DefaultTimeouts;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DefaultTimeoutsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DefaultTimeouts::class);
    }
}
