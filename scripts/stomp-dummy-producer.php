<?php

use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\Trust as TrustTopic;

require __DIR__ . '/include.php';

$client = docker_producer_client();

$stomp = new \Stomp\StatefulStomp($client);
$stomp->subscribe(TrustTopic::MOVEMENT_ALL);

$count = 1;

try {
    while(true) {
        $stomp->begin();
        $stomp->send(TrustTopic::MOVEMENT_ALL, new \Stomp\Transport\Message('Hello World! ' . $count));
        $stomp->commit();

        sleep(1);

        $count++;
    }
}
catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}
