<?php

namespace spec\ThirdRailPackages\QueueSubscriber\NetworkRail\Topics;

use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\TrainDescriber;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrainDescriberSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TrainDescriber::class);
    }
}
