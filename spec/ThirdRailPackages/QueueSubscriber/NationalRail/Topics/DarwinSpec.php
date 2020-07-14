<?php

namespace spec\ThirdRailPackages\QueueSubscriber\NationalRail\Topics;

use ThirdRailPackages\QueueSubscriber\NationalRail\Topics\Darwin;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DarwinSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Darwin::class);
    }
}
