<?php

namespace spec\TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics;

use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\Movement;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MovementSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Movement::class);
    }

    function it_can_generate_topic_for_toc()
    {
        $this->getTocMovementTopicFromBusinessCode('HF')->shouldBe('TRAIN_MVT_HF_TOC');
        $this->getTocMovementTopicFromBusinessCode('ej')->shouldBe('TRAIN_MVT_EJ_TOC');
    }
}
