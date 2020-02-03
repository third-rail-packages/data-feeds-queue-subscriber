<?php

namespace Tests\NetworkRail;

use PHPUnit\Framework\TestCase;
use Stomp\Transport\Frame;
use TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics\Trust;

class TrustTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_receive_message_from_movements_feed()
    {
        $client = networkrail_integration_client();
        $client->consume(Trust::MOVEMENT_ALL, function (Frame $frame) use ($client) {
            $this->assertIsString($frame->getBody());
            $this->assertIsArray($frame->getHeaders());

            $client->loopRunning = false;
        });
    }
}
