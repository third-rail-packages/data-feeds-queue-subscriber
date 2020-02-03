<?php

use TrainjunkiesPackages\QueueSubscriber\NetworkRail\SubscriptionFactory;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\Trust as TrustTopic;
use TrainjunkiesPackages\QueueSubscriber\Stomp\Message;

include __DIR__ . '/../include.php';

try {
    SubscriptionFactory::create(
        networkrail_username(),
        networkrail_password()
    )->consume(TrustTopic::MOVEMENT_ALL, function(Message $message) {
        echo $message->getBody() . PHP_EOL;
    });

} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
