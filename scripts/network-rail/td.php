<?php

use Stomp\Exception\ErrorFrameException;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\QueueFactory;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\TrainDescriber as TrainDescriberTopic;

include __DIR__ . '/../include.php';

try {
    QueueFactory::create(
        networkrail_username(),
        networkrail_password()
    )->consume(TrainDescriberTopic::TD_ALL_AREAS, function ($message) {
       var_dump($message);
    });
}
catch (ErrorFrameException $e) {
    var_dump($e->getFrame());
}
