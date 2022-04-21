<?php

use App\Mail\CompanyRecordAvailableEmail;
use App\Mail\ResetPasswordEmail;
use App\Models\CompanyRecordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('/reset-password', function () {
    $user = User::first();
    $token = Str::random(60);

    return new ResetPasswordEmail($user, $token);
});

Route::get('/company-record-available', function () {
    $user = User::first();
    $companyRecordRequest = CompanyRecordRequest::first();

    return new CompanyRecordAvailableEmail($user, $companyRecordRequest);
});
