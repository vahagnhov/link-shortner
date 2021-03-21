<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ShortenLinkController;

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

/*Route::post('generate-shorten-link-post', [ShortenLinkController::class, 'store']);*/

/*Route::resource('/pharmacy-cities', 'Api\ShortenLinkController', ['only' => ['store']]);*/

Route::apiResource('shortenLink', ShortenLinkController::class);