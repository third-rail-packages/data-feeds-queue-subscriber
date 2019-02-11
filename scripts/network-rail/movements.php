<?php

use Stomp\Exception\ErrorFrameException;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\QueueFactory;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\Movement as MovementTopic;

include __DIR__ . '/../include.php';

try {
    QueueFactory::create(
        networkrail_username(),
        networkrail_password()
    )->consume(MovementTopic::MOVEMENT_ALL, function ($message) {
        var_dump($message);
    });
}
catch (ErrorFrameException $e) {
    var_dump($e->getFrame());
}
