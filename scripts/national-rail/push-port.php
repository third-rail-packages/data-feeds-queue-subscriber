<?php

use ThirdRailPackages\QueueSubscriber\NationalRail\Topics;
use ThirdRailPackages\QueueSubscriber\Stomp\Message;

include __DIR__ . '/../include.php';

try {
    nationalrail_simple_client('darwin_local', 'darwin_local')->consume(
        Topics\Darwin::DARWIN,
        function(Message $message) {
            $timestamp = format_datetime_from_milliseconds(
                $message->getHeaders()['timestamp']
            );

            $body = gzdecode($message->getBody());

            echo sprintf(
                "Darwin [%s]: %s",
                $message->getHeaders()['MessageType'],
                $timestamp
            ) . PHP_EOL;

            echo $body . PHP_EOL;
        }
    );

} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
