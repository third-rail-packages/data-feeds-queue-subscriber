<?php

use Stomp\Exception\ErrorFrameException;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\QueueFactory;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\TrainDescriber as TrainDescriberTopic;

include __DIR__ . '/../include.php';

$tdArea = ($argv[1] !== null) ? $argv[1] : 'MS'; // Default to Manchester South
$messageType = ($argv[2] !== null) ? $argv[2] : 'SF'; // Default to Signalling Update

try {
    QueueFactory::create(
        networkrail_username(),
        networkrail_password()
    )->consume(TrainDescriberTopic::TD_ALL_AREAS, function ($message) use ($tdArea, $messageType) {
        $collection = json_decode($message, true);

        $filtered = array_filter($collection, function ($item) use ($tdArea, $messageType) {
            $data = array_shift($item);

            return ($data['msg_type'] === $messageType && $data['area_id'] === $tdArea);
        });

        if (count($filtered) > 0) {
            foreach ($filtered as $sf_message) {
                $message = array_shift($sf_message);

                echo sprintf(
                        'Time: "%s", Area: "%s", Address: "%s", State (HEX): "%s", Sate (Binary): "%s"',
                        datetime_from_milliseconds($message['time'])->format('d/m/y H:i:s'),
                        $message['area_id'],
                        $message['address'],
                        $message['data'],
                        hexagonal_to_binary($message['data'])
                    ) . PHP_EOL;
            }
        }
    });
} catch (ErrorFrameException $e) {
    var_dump($e->getFrame());
}
