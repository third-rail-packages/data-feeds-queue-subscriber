<?php

use Stomp\Exception\ErrorFrameException;
use TrainjunkiesPackages\QueueSubscriber\NationalRail\QueueFactory;

include __DIR__ . '/../include.php';

date_default_timezone_set('UTC');

try {
    QueueFactory::create(
        nationalrail_username(),
        nationalrail_password(),
        nationalrail_host(),
        nationalrail_port()
    )
    ->consumer(nationalrail_topic())
    ->ack(function ($body, $headers) {
        echo "Message Type: " . $headers['MessageType'] . PHP_EOL;
        echo $body . PHP_EOL . PHP_EOL;
    });
}
catch (ErrorFrameException $e) {
    var_dump($e->getFrame());
}
