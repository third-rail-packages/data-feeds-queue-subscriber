<?php

namespace spec\TrainjunkiesPackages\QueueSubscriber\Stomp;

use Stomp\StatefulStomp;
use Stomp\Transport\Frame;
use TrainjunkiesPackages\QueueSubscriber\Client;
use TrainjunkiesPackages\QueueSubscriber\Stomp\Subscription;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Webmozart\Assert\Assert;

class SubscriptionSpec extends ObjectBehavior
{
    const TOPIC = '/topic/feed';
    const BODY = 'Message Body';
    const HEADERS = ['header1', 'header2'];

    function let(
        Client $client,
        StatefulStomp $statefulStomp,
        Frame $frame
    ) {
        $frame->getHeaders()->willReturn(self::HEADERS);
        $frame->getBody()->willReturn(self::BODY);
        $statefulStomp->subscribe(Argument::type('string'))->willReturn(1);
        $statefulStomp->read()->willReturn($frame);
        $client->subscription()->willReturn($statefulStomp);

        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Subscription::class);
    }

    function it_can_consume_stomp_destination(
        Client $client,
        StatefulStomp $statefulStomp
    )
    {
        $this->consume(self::TOPIC, function (Frame $frame) {
            Assert::eq($frame->getBody(), self::BODY);

            Assert::eq($frame->getHeaders(), self::HEADERS);

            $this->loopRunning = false;
        });

        $statefulStomp->subscribe(self::TOPIC)
            ->shouldHaveBeenCalled();

        $statefulStomp->read()->shouldHaveBeenCalled();
    }
}
