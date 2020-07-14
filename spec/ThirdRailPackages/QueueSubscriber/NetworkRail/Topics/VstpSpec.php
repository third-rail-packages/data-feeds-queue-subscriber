<?php

namespace spec\ThirdRailPackages\QueueSubscriber\NetworkRail\Topics;

use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\Vstp;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VstpSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Vstp::class);
    }
}
