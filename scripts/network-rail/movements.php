<?php

use Stomp\Exception\ErrorFrameException;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\QueueFactory;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\Movement as MovementTopic;

include __DIR__ . '/../include.php';

try {
    QueueFactory::create(
        networkrail_username(),
        networkrail_password()
    )
    ->consumer(MovementTopic::MOVEMENT_ALL)
    ->ack(function ($body, $headers) {
        var_dump($body);
    });
}
catch (ErrorFrameException $e) {
    var_dump($e->getFrame());
}
