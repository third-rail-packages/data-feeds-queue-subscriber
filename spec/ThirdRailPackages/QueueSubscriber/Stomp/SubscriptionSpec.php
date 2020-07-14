<?php

namespace spec\ThirdRailPackages\QueueSubscriber\Stomp;

use Stomp\StatefulStomp;
use Stomp\Transport\Frame;
use ThirdRailPackages\QueueSubscriber\Client;
use ThirdRailPackages\QueueSubscriber\Stomp\Message;
use ThirdRailPackages\QueueSubscriber\Stomp\Subscription;
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

    function it_can_consume_stomp_destination(StatefulStomp $statefulStomp)
    {
        $this->consume(self::TOPIC, function (Message $message) {
            Assert::eq($message->getBody(), self::BODY);

            Assert::eq($message->getHeaders(), self::HEADERS);

            $this->loopRunning = false;
        });

        $statefulStomp->subscribe(self::TOPIC)
            ->shouldHaveBeenCalled();

        $statefulStomp->read()->shouldHaveBeenCalled();
    }
}
