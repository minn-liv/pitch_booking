<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('customer.layouts.app');
})->name('homePage');


Route::post('/nguoi-dung/dang-nhap', 'User\AuthController@login')->name('user.postLogin');
Route::get("/dang-xuat", 'User\AuthController@logout')->name('user.logout');
