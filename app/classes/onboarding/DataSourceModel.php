<?php


namespace App\classes\onboarding;


use App\member;

/**
 * Class DataSourceModel
 * @package App\classes\onboarding
 * this class is responsible to determine which model must retrieve data from related source based on value of DATA_DRIVER in .env file
 *
 */
class DataSourceModel
{
    public function __construct()
    {

    }

    /**
     * @return CsvModel|member|null
     */
    public static function getModel(){

        switch (env("DATA_DRIVER")){
            case CSV_SOURCE:
                $pathFile = storage_path("app/".DocumentPath."/".DATASOURCE_FILENAME. ".csv");
                return new CsvModel($pathFile);
            case DATABASE_SOURCE:
                return new member();

            case TXT_SOURCE:

            case EXCEL_SOURCE:
            default:



                return null;
        }
    }
}