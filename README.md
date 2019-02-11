# Trainjunkies - Data Feeds Queue Subscriber

PHP package to consume Open Rail Data feeds from National Rail & Network Rail.

## Installation

```bash
composer require trainjunkies-packages/data-feeds-queue-subscriber
```

## Development

See `scripts` directory for examples.

Copy and complete the `.env.dist` to `.env` and start the Docker compose environment. 

```bash
docker-compose up -d
docker-compose run --rm php php scripts/network-rail/td-logger.php MS
```

To stop the running container;

```bash
docker stop $(docker ps | grep trainjunkies-packages-queue-subscriber_app | awk '{ print $10 }')
```
