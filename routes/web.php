<?php

use App\Http\Controllers\CacheController;
use Illuminate\Support\Facades\Route;

use App\Models\User;


Route::get('/', function () {
    return view('welcome');
});




Route::get('/',[CacheController::class,'normalquery']);

Route::get('/redis',[CacheController::class,'redis_cache']);

Route::get('/redis_cache_delete',[CacheController::class, 'delete']);

Route::get('/phpredis',[CacheController::class, 'phpredis']);