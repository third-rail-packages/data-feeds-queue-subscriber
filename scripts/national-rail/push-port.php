<?php

use TrainjunkiesPackages\QueueSubscriber\Client;
use TrainjunkiesPackages\QueueSubscriber\NationalRail\Topics\Darwin as DarwinTopic;
use TrainjunkiesPackages\QueueSubscriber\Stomp\Message;
use TrainjunkiesPackages\QueueSubscriber\Stomp\OptionsBuilder;
use TrainjunkiesPackages\QueueSubscriber\Stomp\Subscription;

include __DIR__ . '/../include.php';

try {
    $options = (new OptionsBuilder())
        ->withUsername(nationalrail_username())
        ->withPassword(nationalrail_password())
        ->withHost(nationalrail_host())
        ->withPort(nationalrail_port())
        ->build();

    $subscription = new Subscription(new Client($options));

    $subscription->consume(DarwinTopic::DARWIN, function (Message $message) {
        echo PHP_EOL;
        echo gzdecode($message->getBody()) . PHP_EOL;
        echo PHP_EOL;
    });
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
