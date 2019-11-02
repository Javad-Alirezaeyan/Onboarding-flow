<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();

        $steps = Config::get("constants.OnboardingSteps");

        $id =$faker->numberBetween(0, 10000000);
        for($i=0; $i < 500; $i++){
            $dt = $faker->dateTimeBetween($startDate = '-3 month', $endDate = 'now');
            $date = $dt->format("Y-m-d");
            $countApp =  $faker->numberBetween(0,10);
            DB::table('members')->insert([
                'user_id' => $id++ ,
                'created_at' => $date,
                'onboarding_perentage' => $steps[$faker->numberBetween(0, count($steps)-1)],
                'count_applications' => $countApp,
                'count_accepted_applications' => $faker->numberBetween(0, $countApp)
            ]);
        }

    }
}
