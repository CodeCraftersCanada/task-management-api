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

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');

    return "Cleared!";

 });

Route::post('/signup', ['as' => '', 'uses' => 'Api\AuthController@createUser']);
Route::post('/signin', ['as' => '', 'uses' => 'Api\AuthController@loginUser']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('user', 'UserController');
    Route::apiResource('task', 'TaskController');
    Route::apiResource('taskStatus', 'TaskStatusController');
    Route::apiResource('subTask', 'SubTaskController');
    Route::apiResource('invoice', 'InvoiceController');
});
