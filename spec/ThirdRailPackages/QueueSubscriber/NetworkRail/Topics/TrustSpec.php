<?php

namespace spec\ThirdRailPackages\QueueSubscriber\NetworkRail\Topics;

use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\Trust;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrustSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Trust::class);
    }

    function it_can_generate_topic_for_toc()
    {
        $this::tocMovementTopicFromBusinessCode('HF')->shouldBe('TRAIN_MVT_HF_TOC');
        $this::tocMovementTopicFromBusinessCode('ej')->shouldBe('TRAIN_MVT_EJ_TOC');
    }
}
