<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlantController;
use L5Swagger\Http\Controllers\SwaggerController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class , 'login']);
Route::post('/register', [AuthController::class , 'register']);

Route::middleware('auth:sanctum')-> group(function () {
    Route::post('/logout', [AuthController::class , 'logout']);
});
Route::get('/plant', [PlantController::class, 'index']);
Route::post('/plant', [PlantController::class, 'store']);
Route::get('/plant/{name}', [PlantController::class, 'show']);
Route::delete('/plant/{id}', [PlantController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user/plant', [UserPlantController::class, 'store']);
    Route::get('/user/plants', [UserPlantController::class, 'index']);
    Route::delete('/user/plant/{id}', [UserPlantController::class, 'destroy']);
});
    
Route::get('/users', [AuthController::class, 'index']);
Route::post('/users', [AuthController::class, 'store']);
Route::get('/users/{id}', [AuthController::class, 'show']);

Route::post('/plant/update', [PlantController::class, 'updatePlants']);

Route::get('/documentation', [SwaggerController::class, 'api']);