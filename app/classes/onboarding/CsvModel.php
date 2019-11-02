<?php
namespace App\classes\onboarding;


/**
 * Class CsvModel
 * @package App\classes\onboarding
 * this class is responsible to extract data from csv file
 *
 */
class CsvModel implements InterfaceOnboardingData
{

    public $filepath;
    const INDEX_Date = 1, INDEX_PERCENTAGE = 2;
    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * @return array
     * this method read data from csv file and arrange in an array
     */
    public function loadData()
    {
        //check if the file is exist
        /*if(!file_exists($this->filepath)){
            return [];
        }*/
        // reading data of csv file
        $file = fopen($this->filepath, "r");
        $all_data = array();
        //get first record, we don't need this record because it is the header
        fgetcsv($file, 1000, ",");
        while ( ($data = fgetcsv($file, 1000, ",")) !==FALSE ) {
            $temp = explode(";", $data[0]);
            $all_data[] = [
                $temp[self::INDEX_Date],
                $temp[self::INDEX_PERCENTAGE]
            ];
        }
        return $all_data;
    }


}