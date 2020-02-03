<?php

namespace spec\TrainjunkiesPackages\QueueSubscriber\NationalRail\Stomp;

use Stomp\Transport\Frame;
use TrainjunkiesPackages\QueueSubscriber\NationalRail\Stomp\Message;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TrainjunkiesPackages\QueueSubscriber\Stomp\MessageInterface;

class MessageSpec extends ObjectBehavior
{
    const MESSAGE_BODY = 'Darwin Push Port Message';

    function let(Frame $frame)
    {
        $frame->getBody()->willReturn(gzencode(self::MESSAGE_BODY));

        $this->beConstructedWith($frame);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Message::class);
        $this->shouldImplement(MessageInterface::class);
    }

    function it_can_decode_message_body()
    {
        $this->getBody()->shouldBe(self::MESSAGE_BODY);
    }
}
