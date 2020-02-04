<?php

use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\Vstp as VstpTopic;
use TrainjunkiesPackages\QueueSubscriber\Stomp\Message;

include __DIR__ . '/../include.php';

try {
    networkrail_simple_client()
        ->consume(
            VstpTopic::VSTP_ALL,
            function(Message $message) {
                echo $message->getBody() . PHP_EOL;
            }
        );
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
