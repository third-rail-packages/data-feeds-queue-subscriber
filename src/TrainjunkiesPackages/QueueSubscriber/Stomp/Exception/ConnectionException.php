<?php

namespace TrainjunkiesPackages\QueueSubscriber\Stomp\Exception;

use TrainjunkiesPackages\QueueSubscriber\Stomp\Options;

class ConnectionException extends \Exception
{
    /**
     * @param Options $options
     *
     * @return ConnectionException
     */
    public static function missingHostOrPort(Options $options)
    {
        return new self(
            sprintf(
                'Missing STOMP host ("%s") or port number ("%s")',
                $options->host(),
                $options->port()
            )
        );
    }
}
