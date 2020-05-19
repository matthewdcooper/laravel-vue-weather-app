<?php

use Zttp\Zttp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// TODO: add middleware to whitelist ip either of localhost or wherever this is hosted
Route::get('/weather', function () {
    $lat = request('lat'); 
    $lon = request('lon');
    $api_key = config('services.openweathermap.key');
    $url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon";
    $url .= "&appid=$api_key";
    $response = Zttp::get($url);
    return $response->json();
});