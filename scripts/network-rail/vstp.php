<?php

use Stomp\Exception\ErrorFrameException;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\QueueFactory;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\Vstp;

include __DIR__ . '/../include.php';

try {
    QueueFactory::create(
        networkrail_username(),
        networkrail_password()
    )
    ->consumer(Vstp::VSTP_ALL)
    ->ack(function($body, $headers) {
        echo $body . PHP_EOL . PHP_EOL;
    });
} catch (ErrorFrameException $e) {
    var_dump($e->getFrame());
}
