<?php

use App\Http\Controllers\API\Host\AuthController;
use App\Http\Middleware\CheckRole;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'API'], function () {

    Route::group(['prefix' => 'host', 'namespace' => 'Host'], function () {
        Route::post('register', 'AuthController@register');
        Route::post('login',  'AuthController@login');
        Route::post('logout', 'AuthController@logout');

        Route::middleware(['auth:api', 'check_role'])->group(function () {
            Route::get('list-pitch', 'PitchController@list');
            Route::get('detail-pitch', 'PitchController@detail');
            Route::post('create-pitch', 'PitchController@store');
            Route::post('edit-pitch', 'PitchController@edit');
            Route::delete('delete-pitch', 'PitchController@delete');

            Route::post('create-pitch-information', 'PitchInformationController@store');
            Route::post('edit-pitch-information', 'PitchInformationController@edit');
            Route::get('detail-pitch-information', 'PitchInformationController@detail');
            Route::delete('delete-pitch-information', 'PitchInformationController@delete');

            Route::get('list-booking-all', 'BookingController@list');
            Route::get('list-booking', 'BookingController@listByUser');
            Route::post('accept-booking', 'BookingController@accept');

            Route::post('create-match', 'MatchController@store');
        });
    });

    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
        Route::post('register', 'AuthController@register');
        Route::post('login',  'AuthController@login');
        Route::post('logout', 'AuthController@logout');

        Route::middleware('auth:api')->group(function () {

            Route::post('booking', 'BookingController@store');
            Route::get('list-booking', 'BookingController@listByUser');
            Route::post('create-match', 'MatchController@store');
        });

        Route::get('detail-pitch', 'PitchController@detail');
        Route::get('filter',  'PitchController@filter');
        Route::get('list-match', 'MatchController@list');
    });
});