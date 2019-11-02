<?php


namespace App\classes\onboarding;

/**
 * Class OnboardData
 * @package App\classes\onboarding
 */
class OnboardData
{
    public $model =null;

    /**
     * OnboardData constructor.
     * @param InterfaceOnboardingData $model
     *
     */
    public function __construct(InterfaceOnboardingData $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public  function loadData(){
        return $this->sortData($this->model->loadData());
    }

    /**
     * @param $list
     * @return mixed
     * this functions sort
     */
    public function sortData($list)
    {
        usort($list, "cmp");
        return $list;
    }





}