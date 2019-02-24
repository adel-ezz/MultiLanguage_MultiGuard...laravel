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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'GeneralController@login');
Route::group(['middleware'=>'auth:api'],function (){
    /////Get specifice Department with its user
    Route::get('/department/{id}','GeneralController@department');
    /////Get specifice user with its department
    Route::get('/user/{id}','GeneralController@user');
});
