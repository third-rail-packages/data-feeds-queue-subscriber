<?php

namespace spec\TrainjunkiesPackages\QueueSubscriber\NationalRail\Topics;

use TrainjunkiesPackages\QueueSubscriber\NationalRail\Topics\Darwin;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DarwinSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Darwin::class);
    }
}
