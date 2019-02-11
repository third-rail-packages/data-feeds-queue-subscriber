<?php

namespace TrainjunkiesPackages\QueueSubscriber\Queue;

use Enqueue\Stomp\StompConnectionFactory;

class ContextFactory
{
    public static function create($username, $password, $host, $port)
    {
        return (new StompConnectionFactory([
            'login'    => $username,
            'password' => $password,
            'host'     => $host,
            'port'     => $port,
        ]))->createContext();
    }
}
