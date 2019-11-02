<?php

use Illuminate\Support\Facades\Config;
/**
 * @param $a
 * @param $b
 * @return int
 * To sort a two-dimension array
 */
function cmp($a, $b)
{
    if ($a[0] == $b[0]) {
        return 0;
    }
    return ($a[0] < $b[0]) ? -1 : 1;
}


function findStuckStep($groupedList, $allUserCount){
    $stepsInfo =  Config::get("constants.OnboardingStepsInfo");

    $stuckStep = -1;
    $maxStuck = 0;
    foreach ($stepsInfo as $key=>$value){
        $stepsInfo[$key]['WeekMaxCount'] = 0;
        $stepsInfo[$key]['UserCount'] = 0;
        $stepsInfo[$key]['PercentageToAll'] = 0;
        $stepsInfo[$key]['Step'] = $key;
    }

    foreach ($groupedList as $data_period){
        $percentage = $data_period['percentage'];
        unset($percentage[0]);
        unset($percentage[count($percentage)]);
        list($maxIndex) = array_keys($percentage, max($percentage));
        $stepsInfo[$maxIndex]['WeekMaxCount'] += 1;

        if($stepsInfo[$maxIndex]['WeekMaxCount'] > $maxStuck){
            $maxStuck = $stepsInfo[$maxIndex]['WeekMaxCount'];
            $stuckStep = $maxIndex;
        }

        foreach ($data_period['percentage'] as $key=>$value){
            $stepsInfo[$key]['UserCount'] += $value;
        }

    }

    foreach ($stepsInfo as $key=>$item){
        $stepsInfo[$key]['PercentageToAll'] += round( $stepsInfo[$key]['UserCount']/ $allUserCount, 4) *100;
    }

    return [$stepsInfo, $stuckStep];
}