<?php

use Stomp\Network\Observer\ServerAliveObserver;
use TrainjunkiesPackages\QueueSubscriber\Client;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\Vstp as VstpTopic;
use TrainjunkiesPackages\QueueSubscriber\Stomp\DurableSubscription;
use TrainjunkiesPackages\QueueSubscriber\Stomp\OptionsBuilder;

include __DIR__ . '/../include.php';

try {
    $options = (new OptionsBuilder())
        ->withUsername(networkrail_username())
        ->withPassword(networkrail_password())
        ->withHost(networkrail_host())
        ->withPort(networkrail_port())
        ->withClientId('trainjunkies-packages_queue-subscriber_vstp-durable-dev-' . uniqid(true))
        ->withSubscriptionName(networkrail_durable_subscription_name(VstpTopic::VSTP_ALL))
        ->build();

    $client = new Client($options);

    $subscription = new DurableSubscription(
        $client,
        new ServerAliveObserver()
    );

    $subscription->consume(VstpTopic::VSTP_ALL, function($frame) {
        echo $frame->body . PHP_EOL;
    });
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
