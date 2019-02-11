<?php

namespace TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics;

class Movement
{
    const MOVEMENT_ALL = 'TRAIN_MVT_ALL_TOC';
    const MOVEMENT_FREIGHT = 'TRAIN_MVT_ALL_TOC';
    const MOVEMENT_GENERAL = 'TRAIN_MVT_ALL_TOC';

    public function getTocMovementTopicFromBusinessCode($businessCode)
    {
        return sprintf("TRAIN_MVT_%s_TOC", strtoupper($businessCode));
    }
}
