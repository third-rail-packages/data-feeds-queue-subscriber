<?php

namespace spec\ThirdRailPackages\QueueSubscriber\NetworkRail\Topics;

use Support\CustomMatchersTrait;
use ThirdRailPackages\QueueSubscriber\NetworkRail\Topics\TrainDescriber;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrainDescriberSpec extends ObjectBehavior
{
    use CustomMatchersTrait;

    function it_is_initializable()
    {
        $this->shouldHaveType(TrainDescriber::class);
    }

    function it_has_constants()
    {
        $this->shouldhaveConstants([
            'TD_ALL_AREAS' => '/topic/TD_ALL_SIG_AREA',
            'TD_ANGLIA_AREA' => '/topic/TD_ANG_SIG_AREA',
            'TD_KENT_MIDLANDS_CONTINENTAL_AREA' => '/topic/TD_KENT_MCC_SIG_AREA',
            'TD_LONDON_NE_GREAT_NORTHERN_AREA' => '/topic/TD_LNE_GN_SIG_AREA',
            'TD_LONDON_NE_NORTH_EAST_AREA' => '/topic/TD_LNE_NE_SIG_AREA',
            'TD_LONDON_NW_CENTRAL_AREA' => '/topic/TD_LNW_C_SIG_AREA',
            'TD_LONDON_NW_LANCASHIRE_CUMBRIA_AREA' => '/topic/TD_LNW_LC_SIG_AREA',
            'TD_LONDON_NW_WEST_MIDLANDS_AREA' => '/topic/TD_LNW_WMC_SIG_AREA',
            'TD_MIDLANDS_CONTINENTAL_EAST_MIDLANDS_AREA' => '/topic/TD_MC_EM_SIG_AREA',
            'TD_SCOTLAND_EAST_AREA' => '/topic/TD_SE_SIG_AREA',
            'TD_SCOTLAND_WEST_AREA' => '/topic/TD_SW_SIG_AREA',
            'TD_SUSSEX_AREA' => '/topic/TD_SUSS_SIG_AREA',
            'TD_WESSEX_AREA' => '/topic/TD_WESS_SIG_AREA',
            'TD_WESTERN_THAMES_VALLEY_AREA' => '/topic/TD_WTV_SIG_AREA',
            'TD_WESTERN_WALES_MARCHES' => '/topic/TD_WWM_SIG_AREA',
            'TD_WESTERN_WEST_COUNTRY' => '/topic/TD_WWC_SIG_AREA',
            'TD_WEST_COAST_SOUTH_AREA' => '/topic/TD_WCS_SIG_AREA',
        ]);
    }
}
