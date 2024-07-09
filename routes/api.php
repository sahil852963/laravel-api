<?php

use App\Http\Controllers\API\Authcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('signup', [Authcontroller::class, 'signUp']);
Route::post('login', [Authcontroller::class, 'login']);
Route::post('logout', [Authcontroller::class, 'logOut'])->middleware('auth:sanctum');