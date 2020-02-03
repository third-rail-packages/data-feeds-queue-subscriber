<?php

namespace spec\TrainjunkiesPackages\QueueSubscriber\Stomp;

use Stomp\Client as StompClient;
use Stomp\Network\Connection as StompConnection;
use Stomp\Network\Observer\ConnectionObserverCollection;
use Stomp\Network\Observer\ServerAliveObserver;
use Stomp\StatefulStomp;
use Stomp\Transport\Frame;
use TrainjunkiesPackages\QueueSubscriber\Client;
use TrainjunkiesPackages\QueueSubscriber\Stomp\DurableSubscription;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TrainjunkiesPackages\QueueSubscriber\Stomp\OptionsBuilder;
use TrainjunkiesPackages\QueueSubscriber\Stomp\SubscriberInterface;

class DurableSubscriptionSpec extends ObjectBehavior
{
    const TOPIC = '/topic/trains';
    const STOMP_SUBSCRIPTION_NAME = 'stomp-subscription';

    function let(
        Client $client,
        StompClient $stompClient,
        StatefulStomp $statefulStomp,
        StompConnection $stompConnection,
        ServerAliveObserver $heartbeatObserver,
        ConnectionObserverCollection $observerCollection,
        Frame $stompFrame
    ) {
        $options = (new OptionsBuilder())
            ->withSubscriptionName(self::STOMP_SUBSCRIPTION_NAME)
            ->build();

        $statefulStomp->ack($stompFrame)->willReturn(null);
        $statefulStomp->read()->willReturn($stompFrame);
        $statefulStomp->subscribe(
            Argument::type('string'),
            null,
            'client-individual',
            Argument::any()
        )->willReturn(1);
        $heartbeatObserver->isDelayed()->willReturn(null);
        $heartbeatObserver->isEnabled()->willReturn(true);
        $observerCollection->addObserver(Argument::any())->willReturn(null);
        $stompConnection->getObservers()->willReturn($observerCollection);
        $stompConnection->setReadTimeout(Argument::type('int'))->willReturn(null);
        $stompClient->getConnection()->willReturn($stompConnection);
        $stompClient->setHeartbeat(
            Argument::type('int'),
            Argument::type('int')
        )->willReturn(null);
        $client->stompClient()->willReturn($stompClient);
        $client->subscription()->willReturn($statefulStomp);
        $client->options()->willReturn($options);

        $this->beConstructedWith($client, $heartbeatObserver);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DurableSubscription::class);
        $this->shouldImplement(SubscriberInterface::class);
    }

    function it_can_consume_durable_subscription(
        StompConnection $stompConnection,
        StompClient $stompClient,
        ConnectionObserverCollection $observerCollection,
        StatefulStomp $statefulStomp,
        ServerAliveObserver $heartbeatObserver,
        Frame $stompFrame
    ) {
        $function = function(Frame $frame) {
            $this->loopRunning = false;
        };

        $this->consume(self::TOPIC, $function);

        $stompConnection->setReadTimeout(5)->shouldHaveBeenCalled();

        $stompClient->setHeartbeat(0, 15000)->shouldHaveBeenCalled();

        $observerCollection->addObserver($heartbeatObserver)->shouldHaveBeenCalled();

        $statefulStomp->subscribe(
            self::TOPIC,
            null,
            'client-individual',
            ['activemq.subscriptionName' => self::STOMP_SUBSCRIPTION_NAME]
        )->shouldHaveBeenCalled();

        $heartbeatObserver->isEnabled()->shouldHaveBeenCalled();

        $heartbeatObserver->isDelayed()->shouldHaveBeenCalled();

        $statefulStomp->read()->shouldHaveBeenCalled();

        $statefulStomp->ack($stompFrame)->shouldHaveBeenCalled();
    }

    function it_can_throw_exception_when_heartbeats_are_disabled(
        ServerAliveObserver $heartbeatObserver
    ) {
        $heartbeatObserver->isEnabled()->willReturn(false);

        $this->shouldThrow(\Exception::class)->duringConsume(self::TOPIC, function () {
            $this->loopRunning = false;
        });


    }
}
