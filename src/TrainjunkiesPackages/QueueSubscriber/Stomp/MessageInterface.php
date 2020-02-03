<?php

namespace TrainjunkiesPackages\QueueSubscriber\Stomp;

interface MessageInterface
{
    /**
     * @return array<string>
     */
    public function getHeaders(): array;

    /**
     * @return string|false
     */
    public function getBody();
}
