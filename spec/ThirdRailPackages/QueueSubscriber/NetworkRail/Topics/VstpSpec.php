<?php

namespace spec\ThirdRailPackages\QueueSubscriber\NetworkRail\Topics;

use Support\CustomMatchersTrait;
use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\Vstp;
use PhpSpec\ObjectBehavior;

class VstpSpec extends ObjectBehavior
{
    use CustomMatchersTrait;

    function it_is_initializable()
    {
        $this->shouldHaveType(Vstp::class);
    }

    function it_has_constants()
    {
        $this->shouldhaveConstants([
            'VSTP_ALL' => '/topic/VSTP_ALL',
        ]);
    }
}
