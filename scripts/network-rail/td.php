<?php

use Stomp\Exception\ErrorFrameException;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\QueueFactory;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\TrainDescriber as TrainDescriberTopic;

include __DIR__ . '/../include.php';

try {
    QueueFactory::create(
        networkrail_username(),
        networkrail_password()
    )
    ->consumer(TrainDescriberTopic::TD_ALL_AREAS)
    ->ack(function ($message) {
       echo $message . PHP_EOL . PHP_EOL;
    });
}
catch (ErrorFrameException $e) {
    var_dump($e->getFrame());
}
