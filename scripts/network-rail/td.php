<?php

use TrainjunkiesPackages\QueueSubscriber\NetworkRail\SubscriptionFactory;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\TrainDescriber as TrainDescriberTopic;

include __DIR__ . '/../include.php';

try {
    SubscriptionFactory::create(
        networkrail_username(),
        networkrail_password()
    )->consume(TrainDescriberTopic::TD_ALL_AREAS, function($frame) {
        echo $frame->body . PHP_EOL;
    });

} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
