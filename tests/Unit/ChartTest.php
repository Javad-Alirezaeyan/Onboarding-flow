<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class ChartTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRoutes()
    {
        $response = $this->get('/showChart');
        $response->assertStatus(200);

        $response = $this->get('/periodGroupedData');
        $response->assertStatus(200);

        $response = $this->get('/groupedData');
        $response->assertStatus(200);

    }

    public function testApi(){

        $response = $this->json('get', '/periodGroupedData');

        $response->assertStatus(200)->assertJsonStructure([
                "status",
                "page",
                "chartData"=>[
                        "*"=>[
                            "sum",
                            "percentage"=>[] ,
                            "title"
                        ]
                    ],
                "xAxis",
                "periodType"
            ]);

        $response = $this->json('get', '/periodGroupedData',['periodType'=>MONTHLY]);
        $response->assertJsonFragment(['periodType'=>MONTHLY]);

    }


}
