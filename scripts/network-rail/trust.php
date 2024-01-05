<?php

use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\Trust as TrustTopic;
use ThirdRailPackages\QueueSubscriber\Stomp\Message;

include __DIR__ . '/../include.php';

try {
    networkrail_simple_client('trust_local', 'trust_local')
        ->consume(
            TrustTopic::MOVEMENT_ALL,
            function(Message $message) {
                $timestamp = format_datetime_from_milliseconds(
                    $message->getHeaders()['timestamp']
                );

                echo sprintf(
                    "TRUST: %s - %s",
                    $timestamp,
                    $message->getBody()
                ) . PHP_EOL;
            }
        );

} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
