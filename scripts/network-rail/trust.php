<?php

use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\Trust as TrustTopic;
use ThirdRailPackages\QueueSubscriber\Stomp\Message;

include __DIR__ . '/../include.php';

try {
    networkrail_simple_client()
        ->consume(
            TrustTopic::MOVEMENT_ALL,
            function(Message $message) {
                try {
                    $trust = \ThirdRailPackages\NetworkRailDataFeedMessages\Message\Trust::fromJson($message->getBody());
                    echo 'MESSAGE RECIEVED' . PHP_EOL;

                } catch (\Throwable $e) {
                    echo $e->getMessage() . PHP_EOL;
                    echo PHP_EOL . PHP_EOL;
                    echo $e->getTraceAsString();
                    echo PHP_EOL . PHP_EOL;
                    echo $message->getBody();
                    echo PHP_EOL;
                }
            }
        );

} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
