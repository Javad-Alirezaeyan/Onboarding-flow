<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/




Route::get('/', function () {
    return redirect("showChart");
});
Route::get('/showUploadForm', 'FileController@index')->name("showUploadForm");
Route::post('/uploadFile', 'FileController@uploadFile')->name("uploadFile");
Route::get('/showChart', 'ChartController@showChart')->name("showChart");
Route::get('/periodGroupedData', 'Api\OnboardingController@getPeriodGroupedData');
Route::get('/groupedData', 'Api\OnboardingController@getGroupedData');
Route::get('/analysis', 'Api\OnboardingController@analysisOnboardingSteps');
Route::get('/showAnalysis', 'AnalysisController@showAnalysis')->name("showAnalysis");
