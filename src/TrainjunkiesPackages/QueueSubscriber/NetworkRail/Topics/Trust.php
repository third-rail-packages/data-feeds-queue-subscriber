<?php

namespace TrainjunkiesPackages\QueueSubscriber\NetworkRail\Topics;

class Trust
{
    const MOVEMENT_ALL = '/topic/TRAIN_MVT_ALL_TOC';
    const MOVEMENT_FREIGHT = '/topic/TRAIN_MVT_FREIGHT';
    const MOVEMENT_GENERAL = '/topic/TRAIN_MVT_GENERAL';

    /**
     * @param string $businessCode
     *
     * @return string
     */
    public static function tocMovementTopicFromBusinessCode($businessCode)
    {
        return sprintf("TRAIN_MVT_%s_TOC", strtoupper($businessCode));
    }
}
