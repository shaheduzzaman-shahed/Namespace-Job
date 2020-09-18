<?php

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

Route::middleware('auth:api')->group(function(){
    Route::get('/user', 'Api\UserController@getUser');
    Route::put('/updateUser', 'Api\UserController@updateUser');
    Route::get('/logout','Api\AuthController@logout');
    Route::get('/applyJob/{id}','Api\ApplicationController@applyJob');

    //Post Route
    Route::apiResource('/post','Api\PostController')->middleware('checkCompany');
    Route::get('/getCompanyApplications','Api\CompanyController@getCompanyApplications')->middleware('checkCompany');

});

Route::post('/login','Api\AuthController@login');
Route::post('/register','Api\AuthController@register');

//home page routes
Route::get('/getAllPost','Api\HomepageController@getAllPost');
