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
Route::apiResource('advertisers', 'Api\AdvertiserController');

//Category
Route::apiResource('categories', 'Api\CategoryController');

//Tag
Route::apiResource('tags', 'Api\TagController');

//Advertisement
Route::get('advertisements/filter', 'Api\AdvertisementController@filter')->name('advertisements.filter');
Route::apiResource('advertisements', 'Api\AdvertisementController');





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
