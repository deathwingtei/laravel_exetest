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
    return view('menu');
});

Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
Route::post('/users/update', [App\Http\Controllers\UserController::class,'store'])->name('updateUser');

Route::get('/random', function () {
    return view('random');
});