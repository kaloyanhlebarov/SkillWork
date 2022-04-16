<?php

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

$apiVersion = 1;

// AuthAPI
Route::get('test', function () {
    return ['bbbbb'];
});

Route::group(['prefix' => 'v' . $apiVersion .'/api'], function () {
    Route::get('test', function () {
        return ['aaaaaaa'];
    });
    /*Route::post('login', 'AuthAPI\LoginController@login')->name('login');
    Route::post('sign-in', 'AuthAPI\RegisterController@register')->name('register');

    Route::post('forgotten', 'AuthAPI\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('change-passowrd', 'AuthAPI\ResetPasswordController@reset')->name('password.update');*/
});
