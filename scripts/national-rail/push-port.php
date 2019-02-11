<?php

use Stomp\Exception\ErrorFrameException;
use TrainjunkiesPackages\QueueSubscriber\NationalRail\QueueFactory;

include __DIR__ . '/../include.php';

date_default_timezone_set('UTC');

try {
    QueueFactory::create(
        nationalrail_username(),
        nationalrail_password()
    )->consume(nationalrail_queue(), function ($message) {
        var_dump($message);
    });
}
catch (ErrorFrameException $e) {
    var_dump($e->getFrame());
}
