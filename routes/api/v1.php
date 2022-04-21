<?php

use App\Models\CompanyRecordRequest;
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

Route::group(['namespace' => 'App\Http\Controllers\Api\V1'], function () {
    // Unprotected
    Route::post('login', 'Auth\LoginController@login')->name('login');
    Route::post('sign-in', 'Auth\RegisterController@register')->name('register');
    Route::post('forgotten', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    // Auth protected
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('change-passowrd', 'Auth\ResetPasswordController@reset')->name('password.reset');

        Route::post('company-record-requests', 'CompanyRecordRequestController@store')->name('company-record-requests.store');
        Route::post('company-record-requests/find', 'CompanyRecordRequestController@find')->name('company-record-requests.find');

        Route::post('company-records/find', 'CompanyRecordController@find')->name('company-records.find');
    });
});
