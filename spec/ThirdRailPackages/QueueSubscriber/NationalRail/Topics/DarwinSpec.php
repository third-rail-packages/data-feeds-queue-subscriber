<?php

namespace spec\ThirdRailPackages\QueueSubscriber\NationalRail\Topics;

use PhpSpec\ObjectBehavior;
use Support\CustomMatchersTrait;
use ThirdRailPackages\QueueSubscriber\NationalRail\Topics\Darwin;

class DarwinSpec extends ObjectBehavior
{
    use CustomMatchersTrait;

    function it_is_initializable()
    {
        $this->shouldHaveType(Darwin::class);
    }

    function it_has_constants()
    {
        $this->shouldhaveConstants([
            'DARWIN' => '/topic/darwin.pushport-v16',
            'STATUS' => '/topic/darwin.status'
        ]);
    }
}
