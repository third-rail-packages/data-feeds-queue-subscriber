<?php

namespace TrainjunkiesPackages\QueueSubscriber\NationalRail\Stomp;

class Message extends \TrainjunkiesPackages\QueueSubscriber\Stomp\Message
{
    /**
     * @return false|string
     */
    public function getBody()
    {
        return gzdecode($this->frame->getBody());
    }
}
