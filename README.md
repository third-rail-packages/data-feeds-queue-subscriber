# The Third Rail - Data Feeds Queue Subscriber

![CI](https://github.com/third-rail-packages/data-feeds-queue-subscriber/workflows/CI/badge.svg)

PHP package to consume Open Rail Data feeds from National Rail & Network Rail via Active MQ STOMP. Supports durable connections with server heartbeats.


## Installation

### via Composer

Install [Composer](https://getcomposer.org/doc/00-intro.md)  and require the package with the below command.

```bash
composer require third-rail-packages/data-feeds-queue-subscriber
```


## Getting Started

### National Rail - DARWIN PushPort

Signup to the [National Rail Open Data feeds](https://opendata.nationalrail.co.uk/) to generate  your unique credentials. More information can be found on the [Open Rail Data Wiki](https://wiki.openraildata.com/index.php?title=Darwin:Push_Port#Usage).

`./scripts/national-rail`


### Network Rail - NROD, TRUST, TD

Signup to the [Network Rail Open Data platform](https://datafeeds.networkrail.co.uk/) to generate a username and password for the feeds. Be sure to activate the Active MQ topics you wish to subscribe to. More information can be found on the [Open Rail Data Wiki](https://wiki.openraildata.com/index.php?title=About_the_Network_Rail_feeds#How_do_I_get_the_data.3F)

Example code can be found in `./scripts/network-rail`

### Durable Subscription with heartbeats

Below example with request a durable connection with supplied Client ID and ActiveMQ subscription name expecting a heartbeat frame from the server every 20 seconds while emitting one every 5.



```php
<?php // ./trust-durable-example.php

use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics;
use ThirdRailPackages\QueueSubscriber\Stomp\DurableSubscription;
use ThirdRailPackages\QueueSubscriber\Stomp\Message;
use ThirdRailPackages\QueueSubscriber\Stomp\StompClientFactory;

include __DIR__ . '/vendor/autoload.php';

try {
    // Additional arguments can be useed to configure Stomp connection
    $client = StompClientFactory::make(
        'publicdatafeeds.networkrail.co.uk',
        61618,
        'mynrod-email@example.com',
        'S3eC7et'
    );

    // Consult Open Rail Data wiki on Best practice for durable subscriptions
    return new DurableSubscription(
        $client,
        'my-nrod-production'
    );

    $subscription->consume(Topics\Trust::MOVEMENT_ALL, function(Message $message) {
        echo PHP_EOL;
        var_dump(json_decode($message->getBody(), true));
        echo PHP_EOL;
    });
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    // Place sleep(X) here or implement exponential backoff
    exit(1);
}

```


## Development

Copy and complete `.env.dist` to `.env` with desired feed credentials.

The development environment and dependencies are managed with [Docker](https://www.docker.com/get-started). In the same directory as the checked out cloned repository, run the below command to start the Docker Compose environment.
```bash
docker-compose up -d --build
```

Login to the `app` container begin development.
```
docker-compose run --rm app sh
```

Example scripts can be executed inside.
```
php scripts/network-rail/trust.php
```

[Xdebug](https://xdebug.org/) has also been installed to debug PHP.

An ActiveMQ container is also present to aid development / debugging. The management interface can be accessed through a browser on `http://localhost:8181/admin` with the credentials `admin` & `admin`.


## Authors

- **Ben McManus** - [bennoislost](https://github.com/bennoislost)

See also the list of [contributors](https://github.com/third-rail-packages/data-feeds-queue-subscriber/contributors) who participated in this project


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

- [https://groups.google.com/forum/#!forum/openraildata-talk](https://groups.google.com/forum/#!forum/openraildata-talk)
- [https://wiki.openraildata.com/](https://wiki.openraildata.com/)

