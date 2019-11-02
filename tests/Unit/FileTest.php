<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRoutes()
    {
        $response = $this->get('/showUploadForm');
        $response->assertStatus(200);

    }

    public function testFileUpload()
    {

        $file = UploadedFile::fake()->create('data.csv');

        $response = $this->json('POST', '/uploadFile', [
            'file' => $file,
        ]);

        $response->assertExactJson(["status"=>"ok"]);

        // wrong format
        $file = UploadedFile::fake()->create('data.csv11');

        $response = $this->json('POST', '/uploadFile', [
            'file' => $file,
        ]);

        $response->assertStatus(422);
    }
}
