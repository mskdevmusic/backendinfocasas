<?php

use App\Http\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tasks/{id}', [TaskController::class, 'getTask'])->whereNumber('id');
Route::get('/tasks', [TaskController::class, 'getAllTask']);
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask'])->whereNumber('id');
Route::put('/tasks', [TaskController::class, 'updateTask']);
Route::post('/tasks', [TaskController::class, 'insertTask']);