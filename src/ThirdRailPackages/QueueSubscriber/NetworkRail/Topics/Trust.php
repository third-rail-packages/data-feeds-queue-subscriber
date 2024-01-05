<?php

namespace ThirdRailPackages\QueueSubscriber\NetworkRail\Topics;

class Trust
{
    public const MOVEMENT_ALL = '/topic/TRAIN_MVT_ALL_TOC';

    public const MOVEMENT_FREIGHT = '/topic/TRAIN_MVT_FREIGHT';

    public const MOVEMENT_GENERAL = '/topic/TRAIN_MVT_GENERAL';

    /**
     * @param string $businessCode
     *
     * @return string
     */
    public static function tocMovementTopicFromBusinessCode($businessCode)
    {
        return sprintf('TRAIN_MVT_%s_TOC', strtoupper($businessCode));
    }
}
