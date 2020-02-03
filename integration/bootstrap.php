<?php

use TrainjunkiesPackages\QueueSubscriber\NetworkRail\SubscriptionFactory;

require_once __DIR__ . '/../scripts/include.php';

/**
 * @return \TrainjunkiesPackages\QueueSubscriber\Stomp\Subscription
 */
function networkrail_integration_client()
{
    return SubscriptionFactory::create(
        networkrail_username(),
        networkrail_password()
    );
}
