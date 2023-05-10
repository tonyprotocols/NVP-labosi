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
///all the routes that are being used in application
Route::get('/', function () {
    return view('welcome');
});


Route::get('/user/{id}', 'App\Http\Controllers\UserController@getUserById');
Route::put('/user', 'App\Http\Controllers\UserController@update');

Route::get('/task', 'App\Http\Controllers\TaskController@create');
Route::get('/task/application', 'App\Http\Controllers\TaskController@getApplications');
Route::post('/task', 'App\Http\Controllers\TaskController@save');
Route::get('/task/{id}', 'App\Http\Controllers\TaskController@applyForTask');
Route::get('/task/{taskId}/{studentId}', 'App\Http\Controllers\TaskController@selectStudent');

Route::get('/setLang/{locale}', 'App\Http\Controllers\TaskController@setLocale');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
