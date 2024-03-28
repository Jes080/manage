<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('/register', 'App\Http\Controllers\Auth\ApiAuthController@register');
Route::post('/login', 'App\Http\Controllers\Auth\ApiAuthController@login');

