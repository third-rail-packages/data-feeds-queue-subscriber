<?php

use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics;
use ThirdRailPackages\QueueSubscriber\Stomp\Message;

include __DIR__ . '/../include.php';

try {
    networkrail_simple_client('td_local', 'td_local')->consume(
        Topics\TrainDescriber::TD_ALL_AREAS,
        function(Message $message) {
            $timestamp = format_datetime_from_milliseconds(
                $message->getHeaders()['timestamp']
            );

            echo sprintf(
                "TD: %s - %s",
                $timestamp,
                $message->getBody()
            ) . PHP_EOL;
        }
    );

} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
