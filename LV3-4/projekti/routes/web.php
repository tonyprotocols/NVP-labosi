<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/tasks','App\Http\Controllers\TaskController@index');
Route::post('/task','App\Http\Controllers\TaskController@store');
Route::delete('/task/{task}','App\Http\Controllers\TaskController@destroy');

Route::get('/task/edit/{task}', 'App\Http\Controllers\TaskController@edit');
Route::get('/task/editMember/{task}', 'App\Http\Controllers\TaskController@editMember');
Route::patch('/task/{task}', 'App\Http\Controllers\TaskController@update');


Route::auth();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
