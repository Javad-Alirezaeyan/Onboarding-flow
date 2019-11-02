<?php

namespace App\Http\Controllers\Api;

use App\classes\chart\PieChart;
use App\classes\chart\RetentionChart;
use App\Http\Controllers\Controller;
use App\classes\onboarding\OnboardData;
use App\classes\onboarding\DataSourceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

/**
 * Class OnboardingController
 * @package App\Http\Controllers\Api
 * this class is a controller that provide a simple space for API
 */
class OnboardingController extends Controller
{
    /**
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     * this function provide data as groups or categories. It uses period days to divide groups for example weekly, monthly, daily
     * This is function support all types of the data source such as csv, database.
     */
    public function getPeriodGroupedData(Request $req)
    {
        $page = $req->input("page", 1); //we can't use this variable for now
        $periodType = $req->input("periodType", WEEKLY);

        $flowList = $this->extractOnboardingData();
        if(count($flowList) > 0){
            $retention = new RetentionChart(Config::get('constants.OnboardingSteps'), $periodType);
            $groupedData = $retention->groupedData($flowList);
        }
        else{
            $groupedData =[];
        }

        $data =[
            'chartData' => $groupedData,
            'xAxis'=> Config::get('constants.OnboardingStepsTitle'),
            'status' => "ok",
            'page' => $page,
            'periodType' =>$periodType
        ];

        return response()->json($data, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * the data is  grouped in the onboarding steps to consume by pie and bar chart
     */
    public function getGroupedData(){
        $flowList = $this->extractOnboardingData();

        if(count($flowList) > 0){
            $chart = new PieChart(Config::get('constants.OnboardingSteps'));
            $groupedData = $chart->groupedData($flowList);
        }
        else{
            $groupedData = [];
        }
        $data =[
            'chartData' => $groupedData,
            'xAxis'=> Config::get('constants.OnboardingStepsTitle'),
            'status' => "ok",

        ];
        return response()->json($data, 200);
    }


    /**
     * @return mixed
     * this function extract data from the related data source that has set in the .env file
     */
    private function extractOnboardingData(){
        //getting the related model
        $dataSource = DataSourceModel::getModel();
        //pass the model to the "OnboardData" to extract data
        $onboardData = new OnboardData($dataSource);
        return $onboardData->loadData();
    }


    /**
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     * this function do an analysis on the retention chart
     */
    public function analysisOnboardingSteps(Request $req){

        $periodType = $req->input("periodType", WEEKLY);


        $flowList = $this->extractOnboardingData();

        if(count($flowList) > 0){
            $retention = new RetentionChart(Config::get('constants.OnboardingSteps'), $periodType);
            $retention->groupedData($flowList);

            list($analusisData, $stuckStep) = findStuckStep($retention->getGroupedData(), count($flowList));
        }
        else{
            $analusisData =[];
            $stuckStep =-1;
        }
        $data =[
            'analysisData' => $analusisData,
            'StuckStep' =>$stuckStep,
            'status' => "ok",
        ];
        return response()->json($data, 200);

    }


}
