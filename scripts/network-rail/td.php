<?php

use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\TrainDescriber as TrainDescriberTopic;
use ThirdRailPackages\QueueSubscriber\Stomp\Message;

include __DIR__ . '/../include.php';

try {
    networkrail_simple_client()->consume(
        TrainDescriberTopic::TD_ALL_AREAS,
        function(Message $message) {
            echo $message->getBody() . PHP_EOL;
        }
    );

} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
