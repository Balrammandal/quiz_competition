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
Route::group(['prefix'=>'v1','middleware'=>'ApiMiddleWare'], function () {
    Route::get('/get-countries','Api\RegistrationController@getCountries');
    Route::get('/get-states/{country_id}','Api\RegistrationController@getStates');
    /* Login Register Route start here*/
    Route::post('/register','Api\RegistrationController@signup');
    Route::post('/login','Api\RegistrationController@signin');
    Route::post('/verify-account', 'Api\RegistrationController@verifyAccount');
    Route::post('/forget-password','Api\RegistrationController@forgePassword');
    Route::post('/check-otp', 'Api\RegistrationController@checkOtp');
    Route::post('/reset-password','Api\RegistrationController@resetPassword');

});


Route::group(['prefix'=>'v1','middleware'=>['ApiMiddleWare','auth:api']], function () {
    Route::get('/my-subscriptions','Api\SubscriptionController@mySubscrption');
});

