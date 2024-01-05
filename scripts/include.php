<?php

use Stomp\Network\Connection;

include __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('UTC');

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

function nationalrail_host()
{
    return getenv('NATIONALRAIL_HOST');
}

function nationalrail_port()
{
    return getenv('NATIONALRAIL_PORT');
}

function nationalrail_username()
{
    return getenv('NATIONALRAIL_USERNAME');
}

function nationalrail_password()
{
    return getenv('NATIONALRAIL_PASSWORD');
}

function nationalrail_topic()
{
    return getenv('NATIONALRAIL_TOPIC');
}

function networkrail_host()
{

    return getenv('NETWORKRAIL_HOST');
}

function networkrail_port()
{
    return getenv('NETWORKRAIL_PORT');
}

function networkrail_username()
{
    return getenv('NETWORKRAIL_USERNAME');
}

function networkrail_password()
{
    return getenv('NETWORKRAIL_PASSWORD');
}


function networkrail_simple_client(string $subscriptionKey): \ThirdRailPackages\QueueSubscriber\Stomp\DurableSubscription
{
    if (strlen($subscriptionKey) === 0) {
        throw new \Exception('Please provide a custom subscription key');
    }

    $client = \ThirdRailPackages\QueueSubscriber\Stomp\StompClientFactory::make(
        networkrail_host(),
        networkrail_port(),
        networkrail_username(),
        networkrail_password(),
        0,
        0,
    );

    return new \ThirdRailPackages\QueueSubscriber\Stomp\DurableSubscription(
        $client,
        networkrail_durable_subscription_name($subscriptionKey)
    );
}

function networkrail_durable_subscription_name($feed)
{
    $feed = str_replace('/topic/', '', $feed);

    return sprintf(
        'third-rail-packages-queue-subscriber_%s_development',
        strtolower($feed)
    );
}

function hexagonal_to_binary($hexadecimal)
{
    return str_pad(base_convert($hexadecimal, 16, 2), 8, 0, STR_PAD_LEFT);
}

/**
 * @param $milliseconds
 *
 * @return DateTimeImmutable
 */
function datetime_from_milliseconds(int $milliseconds)
{
    $utcDate = DateTimeImmutable::createFromFormat(
        'U',
        $milliseconds,
        new DateTimeZone('UTC')
    );

    return $utcDate->setTimezone(new DateTimeZone('Europe/London'));
}

function format_datetime_from_milliseconds($milliseconds)
{
    return datetime_from_milliseconds(
        floor($milliseconds / 1000)
    )->format('Y-m-d H:i:s');
}

function random_string(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
