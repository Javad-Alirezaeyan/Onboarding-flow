<?php


namespace App\classes\chart;

/**
 * Class RetentionChart
 * @package App\classes\chart
 *  * this class create well-formed data that is appropriate for consuming in retention curves
 */
class RetentionChart implements InterfaceFormatChart
{

    private $periodDays;
    private $defaultGroupValue = [];
    private $xAxis;
    private $data;
    private $groupedData;
    private $percentageData;
    public function __construct($xAxis, $periodDays = WEEKLY)
    {
        $this->periodDays = $periodDays;
        $this->xAxis = $xAxis;
        foreach ($xAxis as $value){
            $this->defaultGroupValue[$value] = 0;
        }
    }


    public function setData($data){
        $this->data = $data;
    }

    public function getGroupedData(){
        return $this->groupedData;
    }

    /**
     * @param array $data
     * @return array
     *  * this function receive all pure data as input, next determines each values is belong to which group(here,
     * $defaultGroupValue is a default instance of categories )
     */
    public function groupedData($data):array
    {
       // $allUserCount = count($data);
        $this->setData($data);
        $groupData = $this->createBound();

        $periodKeys = array_keys($groupData);
        foreach($this->data as $item){
            $value = $item[0];
            $percentageUser = $item[1];


            $findStep = false;
            $percentageIndex = 0;
            //find a appropriate step, some the percentage are between steps, for example 65 is between two different steps(50 and 70)
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


            //finding related category(group) for each value in $data
            $findPeriod = false; // to check if the related category has been found or not
            for($i=0; $i < count($periodKeys)-1; $i++){
                $groupKey = $periodKeys[$i];
                if($groupKey <= $value && $periodKeys[$i+1] > $value){
                    $groupData[$groupKey]['sum'] += 1;
                    $groupData[$groupKey]['percentage'][$percentageIndex] += 1;
                    $findPeriod = true;
                    break;
                }
            }

            if(!$findPeriod){
                // the value is belong to last category
                $groupData[$periodKeys[$i]]['sum'] += 1;
                $groupData[$periodKeys[$i]]['percentage'][$percentageIndex] += 1;
            }

        }

        $this->groupedData = $groupData;
        $percentageData = $groupData;
        //converting the count of users in each step to percentage
        foreach ($percentageData as $key=>$item){
            $sumUsers = $item['sum'];
            if($sumUsers==0){
                continue;
            }
            foreach ($item['percentage'] as $p=>$number){
                if($p == FirsStepRetention){
                    $percentageData[$key]['percentage'][$p]= 100;
                    continue;
                }
                $percentageData[$key]['percentage'][$p]= round($number/ $sumUsers, 4) * 100;
            }
            $percentageData[$key]['percentage'] =  array_values($percentageData[$key]['percentage']);

            $percentageData[$key]['title'] = $key;
        }

        $this->percentageData = $percentageData;
        return array_values($percentageData);// convert associate array to normal array

    }


    /**
     * @return array
     * this method create  a category based on the count of days.
     */
    private function createBound():array
    {
        $data = $this->data;
        $newDate = $data[0][0];
        $maxDate = $data[count($data)-1][0];
        do{
            $period[$newDate] = ['sum'=>0, "percentage"=>$this->defaultGroupValue];
            $tempDate = strtotime($newDate);
            $tempDate = strtotime("+{$this->periodDays} day", $tempDate);
            $newDate = date('Y-m-d', $tempDate);

        }while($newDate < $maxDate);

        return $period;
    }

}