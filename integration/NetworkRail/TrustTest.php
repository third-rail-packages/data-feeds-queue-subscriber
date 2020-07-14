<?php

namespace Tests\NetworkRail;

use PHPUnit\Framework\TestCase;
use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\Trust;
use ThirdRailPackages\QueueSubscriber\Stomp\Message;

class TrustTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_receive_message_from_movements_feed()
    {
        $client = networkrail_simple_client();
        $client->consume(Trust::MOVEMENT_ALL, function (Message $message) use ($client) {
            $this->assertIsString($message->getBody());
            $this->assertIsArray($message->getHeaders());

            $client->loopRunning = false;
        });
    }
}
