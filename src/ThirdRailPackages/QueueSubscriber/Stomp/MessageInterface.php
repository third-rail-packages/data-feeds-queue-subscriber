<?php

namespace ThirdRailPackages\QueueSubscriber\Stomp;

interface MessageInterface
{
    /**
     * @return array<string>
     */
    public function getHeaders(): array;

    /**
     * @return false|string
     */
    public function getBody();
}
