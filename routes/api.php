<?php

use Illuminate\Http\Request;

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


//Advertiser
Route::get('advertisers/filter', 'Api\AdvertiserController@filter')->name('advertisers.filter');
Route::apiResource('advertisers', 'Api\AdvertiserController');

//Category
Route::apiResource('categories', 'Api\CategoryController');

//Tag
Route::apiResource('tags', 'Api\TagController');

//Advertisement
Route::apiResource('advertisements', 'Api\AdvertisementController');





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
