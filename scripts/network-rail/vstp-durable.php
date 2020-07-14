<?php

use Stomp\Network\Observer\ServerAliveObserver;
use ThirdRailPackages\QueueSubscriber\Client;
use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\Vstp as VstpTopic;
use ThirdRailPackages\QueueSubscriber\Stomp\DurableSubscription;
use ThirdRailPackages\QueueSubscriber\Stomp\Message;
use ThirdRailPackages\QueueSubscriber\Stomp\OptionsBuilder;

include __DIR__ . '/../include.php';

try {
    $options = (new OptionsBuilder())
        ->withUsername(networkrail_username())
        ->withPassword(networkrail_password())
        ->withHost(networkrail_host())
        ->withPort(networkrail_port())
        ->withClientId('third-rail-packages_queue-subscriber_vstp-durable-dev-' . uniqid(true))
        ->withSubscriptionName(networkrail_durable_subscription_name(VstpTopic::VSTP_ALL))
        ->build();

    $client = new Client($options);

    $subscription = new DurableSubscription(
        $client,
        new ServerAliveObserver()
    );

    $subscription->consume(VstpTopic::VSTP_ALL, function(Message $message) {
        echo $message->getBody() . PHP_EOL;
    });
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
