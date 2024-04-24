<?php

use App\Http\Controllers\API\Host\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'API'], function () {

    Route::group(['prefix' => 'host', 'namespace' => 'Host'], function () {
        Route::post('register', 'AuthController@register');
        Route::post('login',  'AuthController@login');
        Route::post('create-pitch', 'PitchController@store');
        Route::post('list-pitch', 'PitchController@list');
        Route::post('edit-pitch', 'PitchController@edit');
        Route::delete('delete-pitch', 'PitchController@delete');

        Route::post('accept-booking', 'BookingController@accept');

        Route::post('create-pitch-information', 'PitchInformationController@store');
        Route::post('edit-pitch-information', 'PitchInformationController@edit');
        Route::delete('delete-pitch-information', 'PitchController@delete');

        Route::post('create-match', 'MatchController@store');
    });

    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
        Route::post('register', 'AuthController@register');
        Route::post('login',  'AuthController@login');
        Route::get('filter',  'PitchController@filter');
        Route::get('detail-pitch', 'PitchController@detail');
        Route::post('booking', 'BookingController@booking');
        Route::get('list-booking/{id}', 'BookingController@listByUser');

        Route::post('create-match', 'MatchController@store');
        Route::get('list-match', 'MatchController@list');
    });
});
