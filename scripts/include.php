<?php

include __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('UTC');

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

function nationalrail_queue()
{
    return getenv('NATIONALRAIL_QUEUE');
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

function hexagonal_to_binary($hexadecimal)
{
    return str_pad(base_convert($hexadecimal, 16, 2), 8, 0, STR_PAD_LEFT);
}
