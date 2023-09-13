<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todos/{user_id}', [TodoController::class, 'index']);
Route::prefix('/todo')->group(function(){
    Route::post('/', [TodoController::class, 'store']);

    Route::get('/{id}', [TodoController::class, 'show']);

    Route::put('/{id}', [TodoController::class, 'update']);
    Route::put('/todos/{id}/toggle-checked', [TodoController::class, 'toggleChecked']);

    Route::delete('/{id}', [TodoController::class, 'destroy']);
});
