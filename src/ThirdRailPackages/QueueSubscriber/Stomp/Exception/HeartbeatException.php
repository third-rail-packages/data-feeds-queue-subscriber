<?php

namespace ThirdRailPackages\QueueSubscriber\Stomp\Exception;

class HeartbeatException extends \Exception
{
    /**
     * @return HeartbeatException
     */
    public static function heartbeatNotEnabled()
    {
        return new self('Server is not supporting heartbeats');
    }
}
