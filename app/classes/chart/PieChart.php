<?php


namespace App\classes\chart;


/**
 * Class PieChart
 * @package App\classes\chart
 *
 * this class create well-formed data that is appropriate for consuming in bar and pie chart;
 */
class PieChart implements InterfaceFormatChart
{
    /*
    $xAxis: this variable is for keeping the titles of groups in the charts
    $groupedData : this variable includes the values of each group
    $$percentageData : this variable includes the percentage of each group
    $defaultGroupValue: default values for each group
    */
    private $defaultGroupValue = [];
    private $xAxis;
    private $groupedData; //
    private $percentageData;

    public function __construct($xAxis)
    {
        $this->xAxis = $xAxis;
        foreach ($xAxis as $value){
            $this->defaultGroupValue[$value] = 0;
        }
    }


    /**
     * @param array $data
     * @return array
     * this function receive all pure data as input, next determines each values is belong to which group(here,
     * $defaultGroupValue is a default instance of categories )
     *
     */
    public function groupedData($data):array
    {
        $groupData = $this->defaultGroupValue;
        foreach ($data as $item){
            $value = $item[0];
            $percentageUser = $item[1];

            // finding index in categories($xAxis)
            $findStep = false;
            $percentageIndex = 0;
            for($i=0; $i < count($this->xAxis)-1; $i++){
                $step = $this->xAxis[$i];
                if($step <= $percentageUser && $this->xAxis[$i+1] > $percentageUser){
                    $percentageIndex = $step;
                    $findStep = true;
                    break;
                }
            }
            if(!$findStep){
                //if index didn't find in the loop, it is belong to the last category in the #xAxis array
                $percentageIndex = $this->xAxis[$i];
            }

            $groupData[$percentageIndex] += 1;
        }
        $this->groupedData = $groupData;

        // converting the value of each category to percentage
        $all = count($data);
        $this->groupedData = $groupData;
        $percentageData = $groupData;
        foreach ($percentageData as $key=>$value){
            $percentageData[$key] = [
                "value" => round($value/$all, 2) * 100,
                "name" => $key
                ];
        }

        $this->percentageData = $percentageData;

        return array_values($percentageData); // convert associate array to normal array


    }
}