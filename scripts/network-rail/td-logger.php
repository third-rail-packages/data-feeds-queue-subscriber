<?php

use Stomp\Exception\ErrorFrameException;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\QueueFactory;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\TrainDescriber as TrainDescriberTopic;

include __DIR__ . '/../include.php';

$tdArea = ($argv[1] !== null) ? $argv[1] : 'MS'; // Default to Manchester South

try {
    QueueFactory::create(
        networkrail_username(),
        networkrail_password()
    )->consume(TrainDescriberTopic::TD_ALL_AREAS, function ($message) use ($tdArea) {
        $collection = json_decode($message, true);

        $filtered = array_filter($collection, function($item) use ($tdArea) {
            $data = array_shift($item);

            return ($data['area_id'] === $tdArea);
        });

        foreach ($filtered as $message) {
            $type = key($message);
            $message = array_shift($message);

            switch ($type) {
                case "CA_MSG":
                    echo sprintf(
                            'Type: "%s", Time: "%s", Area: "%s", From: "%s", To: "%s", Description: "%s"',
                            $message['msg_type'],
                            datetime_from_milliseconds($message['time'])->format('d/m/y H:i:s'),
                            $message['area_id'],
                            $message['from'],
                            $message['to'],
                            $message['descr']
                        ) . PHP_EOL;
                    break;
                case "CB_MSG":
                    echo sprintf(
                            'Type: "%s", Time: "%s", Area: "%s", From: "%s", Description: "%s"',
                            $message['msg_type'],
                            datetime_from_milliseconds($message['time'])->format('d/m/y H:i:s'),
                            $message['area_id'],
                            $message['from'],
                            $message['descr']
                        ) . PHP_EOL;
                    break;

                case "CC_MSG":
                    echo sprintf(
                            'Type: "%s", Time: "%s", Area: "%s", To: "%s", Description: "%s"',
                            $message['msg_type'],
                            datetime_from_milliseconds($message['time'])->format('d/m/y H:i:s'),
                            $message['area_id'],
                            $message['to'],
                            $message['descr']
                        ) . PHP_EOL;
                    break;

                case "CT_MSG":
                    echo sprintf(
                            'Type: "%s", Time: "%s", Area: "%s", Report Time: "%s"',
                            $message['msg_type'],
                            datetime_from_milliseconds($message['time'])->format('d/m/y H:i:s'),
                            $message['area_id'],
                            DateTimeImmutable::createFromFormat('Gi', $message['report_time'], new DateTimeZone('UTC'))->format('H:i')
                        ) . PHP_EOL;
                    break;

                case "SF_MSG":
                    echo sprintf(
                            'Type: "%s", Time: "%s", Area: "%s", Address: "%s", State (HEX): "%s", Sate (Binary): "%s"',
                            $message['msg_type'],
                            datetime_from_milliseconds($message['time'])->format('d/m/y H:i:s'),
                            $message['area_id'],
                            $message['address'],
                            $message['data'],
                            hexagonal_to_binary($message['data'])
                        ) . PHP_EOL;
                    break;

                default:
                    echo $message['msg_type'] . PHP_EOL;
            }
        }
    });
}
catch (ErrorFrameException $e) {
    var_dump($e->getFrame());
}
