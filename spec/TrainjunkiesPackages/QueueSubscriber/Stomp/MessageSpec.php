<?php

namespace spec\TrainjunkiesPackages\QueueSubscriber\Stomp;

use Stomp\Transport\Frame;
use TrainjunkiesPackages\QueueSubscriber\Stomp\Message;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TrainjunkiesPackages\QueueSubscriber\Stomp\MessageInterface;

class MessageSpec extends ObjectBehavior
{
    const HEADERS = [
        'id'           => '12345978',
        'content-type' => 'text/json'
    ];
    const BODY = ['train' => 'data', 'todays' => 'date'];

    private $encodedBody;

    function let(Frame $frame)
    {
        $this->encodedBody = json_encode(self::BODY);

        $frame->getBody()->willReturn($this->encodedBody);
        $frame->getHeaders()->willReturn(self::HEADERS);

        $this->beConstructedWith($frame);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Message::class);
        $this->shouldImplement(MessageInterface::class);
    }

    function it_can_decode_message_body()
    {
        $this->getBody()->shouldBe($this->encodedBody);
        $this->getHeaders()->shouldBe(self::HEADERS);
    }
}
