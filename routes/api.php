<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::put('todos/{todo}/check', [TodoController::class, 'updateIsChecked']);
Route::resource('todos', TodoController::class);
Route::resource('users', UserController::class);
