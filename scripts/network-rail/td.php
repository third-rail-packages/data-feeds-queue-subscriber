<?php

use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics;
use ThirdRailPackages\QueueSubscriber\Stomp\Message;

include __DIR__ . '/../include.php';

try {
    $yourUniqueSubscriptionName = '';

    networkrail_simple_client($yourUniqueSubscriptionName)->consume(
        Topics\TrainDescriber::TD_ALL_AREAS,
        function(Message $message) {
            echo $message->getBody() . PHP_EOL;
        }
    );

} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
