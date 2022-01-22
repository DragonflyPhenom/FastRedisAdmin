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
//Админка редиса
Route::get('/', [\App\Http\Controllers\RedisAdmin::class,'getKeysList']);
Route::post('/', [\App\Http\Controllers\RedisAdmin::class,'getKeyValue']);
Route::delete('/', [\App\Http\Controllers\RedisAdmin::class,'deleteKey']);
