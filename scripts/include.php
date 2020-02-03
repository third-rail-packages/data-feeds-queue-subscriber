<?php

include __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('UTC');

function docker_producer_client()
{
    return new Stomp\Client(
        sprintf("tcp://%s:%s", docker_activemq_host(), docker_activemq_port())
    );
}

function docker_activemq_host()
{
    return 'activemq';
}

function docker_activemq_port()
{
    return '61613';
}

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

function networkrail_durable_subscription_name($feed)
{
    $feed = str_replace('/topic/', '', $feed);

    return sprintf(
        'trainjunkies-packages-queue-subscriber_%s_development',
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
function datetime_from_milliseconds($milliseconds)
{
    $utcDate = DateTimeImmutable::createFromFormat(
        'U',
        ($milliseconds / 1000),
        new DateTimeZone('UTC')
    );

    return $utcDate->setTimezone(new DateTimeZone('Europe/London'));
}

function format_datetime_from_milliseconds($milliseconds)
{
    return datetime_from_milliseconds(floor($milliseconds / 1000))
        ->format('d/m/Y H:i:s');
}
