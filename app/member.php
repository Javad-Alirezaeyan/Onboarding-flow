<?php

namespace App;

use App\classes\onboarding\InterfaceOnboardingData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class member extends Model implements InterfaceOnboardingData
{
    //
    public $timestamps = false;


    /**
     * @return array
     * retrieving data from database to pass to th charts
     */
    public function loadData()
    {
        $list = [];
        foreach(DB::table('members')->get() as $user){
            $list[] = [
                $user->created_at,
                $user->onboarding_perentage
            ];
        }
        return $list;
    }


}
