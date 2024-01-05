<?php

namespace ThirdRailPackages\QueueSubscriber\Stomp;

use Stomp\Client;
use Stomp\Network\Connection;
use Stomp\Network\Observer\HeartbeatEmitter;
use Stomp\Network\Observer\ServerAliveObserver;

class StompClientFactory
{
    public static function make(
        string $host,
        int $port,
        string $login,
        string $password,
        int $sendHeartbeat = 5000,
        int $receiveHeartbeat = 20000,
        int $readTimeout = 1,
        int $writeTimeout = 3,
        int $connectionTimeout = 1
    ): Client {
        return self::makeWithConfig([
            'host'               => $host,
            'port'               => $port,
            'login'              => $login,
            'password'           => $password,
            'send_heartbeat'     => $sendHeartbeat,
            'receive_heartbeat'  => $receiveHeartbeat,
            'read_timeout'       => $readTimeout,
            'write_timeout'      => $writeTimeout,
            'connection_timeout' => $connectionTimeout
        ]);
    }

    /**
     * @param array{
     *     host: string,
     *     port: int,
     *     login: string,
     *     password: string,
     *     send_heartbeat: int,
     *     receive_heartbeat: int,
     *     read_timeout: int,
     *     write_timeout: int,
     *     connection_timeout: int
     * } $config
     *
     * @throws \Stomp\Exception\ConnectionException
     */
    public static function makeWithConfig(array $config): Client
    {
        $config = array_merge(self::defaultConfig(), $config);

        $scheme     = 'tcp';
        $uri        = $scheme . '://' . $config['host'] . ':' . $config['port'];
        $connection = new Connection($uri, $config['connection_timeout']);
        $connection->setWriteTimeout($config['write_timeout']);
        $connection->setReadTimeout($config['read_timeout']);

        if ($config['send_heartbeat']) {
            $connection->getObservers()->addObserver(new HeartbeatEmitter($connection));
        }

        if ($config['receive_heartbeat']) {
            $connection->getObservers()->addObserver(new ServerAliveObserver);
        }

        $client = new Client($connection);
        $client->setLogin($config['login'], $config['password']);
        $client->setClientId($config['login']);
        $client->setHeartbeat($config['send_heartbeat'], $config['receive_heartbeat']);

        return $client;
    }

    /**
     * @return array{
     *     host: string,
     *     port: int,
     *     login: string,
     *     password: string,
     *     send_heartbeat: int,
     *     receive_heartbeat: int,
     *     read_timeout: int,
     *     write_timeout: int,
     *     connection_timeout: int
     * }
     */
    private static function defaultConfig(): array
    {
        return [
            'host'               => 'publicdatafeeds.networkrail.co.uk',
            'port'               => 61618,
            'login'              => 'guest',
            'password'           => 'guest',
            'send_heartbeat'     => 0,
            'receive_heartbeat'  => 0,
            'read_timeout'       => 1,
            'write_timeout'      => 3,
            'connection_timeout' => 1
        ];
    }
}
