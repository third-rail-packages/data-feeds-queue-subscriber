<?php

namespace spec\ThirdRailPackages\QueueSubscriber\NetworkRail\Topics;

use Support\CustomMatchersTrait;
use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\Trust;
use PhpSpec\ObjectBehavior;

class TrustSpec extends ObjectBehavior
{
    use CustomMatchersTrait;

    function it_is_initializable()
    {
        $this->shouldHaveType(Trust::class);
    }

    function it_can_generate_topic_for_toc()
    {
        $this::tocMovementTopicFromBusinessCode('HF')->shouldBe('TRAIN_MVT_HF_TOC');
        $this::tocMovementTopicFromBusinessCode('ej')->shouldBe('TRAIN_MVT_EJ_TOC');
    }

    function it_has_constants()
    {
        $this->shouldhaveConstants([
            'MOVEMENT_ALL' => '/topic/TRAIN_MVT_ALL_TOC',
            'MOVEMENT_FREIGHT' => '/topic/TRAIN_MVT_FREIGHT',
            'MOVEMENT_GENERAL' => '/topic/TRAIN_MVT_GENERAL',
        ]);
    }
}
