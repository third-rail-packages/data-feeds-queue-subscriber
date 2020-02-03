<?php

namespace spec\TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics;

use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\TrainDescriber;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrainDescriberSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TrainDescriber::class);
    }
}
