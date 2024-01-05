<?php

use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\Vstp as VstpTopic;
use ThirdRailPackages\QueueSubscriber\Stomp\Message;

include __DIR__ . '/../include.php';

try {
    networkrail_simple_client('vstp_local', 'vstp_local')->consume(
            VstpTopic::VSTP_ALL,
            function(Message $message) {
                $timestamp = format_datetime_from_milliseconds(
                    $message->getHeaders()['timestamp']
                );

                echo sprintf(
                    "VSTP: %s - %s",
                    $timestamp,
                    $message->getBody()
                ) . PHP_EOL;
            }
        );
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
