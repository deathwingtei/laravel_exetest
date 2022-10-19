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

// List User
Route::get('/users', [App\Http\Controllers\UserController::class, 'show']);
//single Users
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show']);
//create new User
Route::post('/user', [App\Http\Controllers\UserController::class, 'store']);
//update User
Route::put('/user/{id}', [App\Http\Controllers\UserController::class, 'update']);
//delete User
Route::delete('/user/{id}', [App\Http\Controllers\UserController::class, 'destroy']);