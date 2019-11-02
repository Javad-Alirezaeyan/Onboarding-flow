<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnalysisTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRoute()
    {
        $response = $this->get('/showAnalysis');
        $response->assertStatus(200);

        $response = $this->get('/analysis');
        $response->assertStatus(200);
    }

    public function testApi(){

        $response = $this->json('get', '/analysis');

        $response->assertStatus(200)->assertJsonStructure([
            "status",
            "analysisData"=>[
                "*"=>[
                    "Title",
                    "WeekMaxCount" ,
                    "UserCount",
                    "Step",
                    "PercentageToAll"
                ]
            ]
        ]);


    }

}
