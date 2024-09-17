<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware'=>'api',
    'prefix'=>'auth'
], function($router){
    Route::post('/register',[AuthController::class,'register'])->name('register');
    Route::post('/login',[AuthController::class,'login'])->name('login');
    Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh',[AuthController::class,'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me',[AuthController::class,'me'])->middleware('auth:api')->name('me');
    Route::get('search/{id}', [AuthController::class,'searchId'])->name('searchId');
});


Route::group([
    'middleware'=>'api',
    'prefix'=>'auth'
], function($router){
    Route::get('/get-api',[RecipeController::class,'index'])->name('get-api');
    Route::post('/store', [RecipeController::class,'store'])->name('store');
    Route::post('/search',[RecipeController::class,'search'])->name('search');
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
