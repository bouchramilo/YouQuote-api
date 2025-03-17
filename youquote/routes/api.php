<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('citations',CitationController::class);
Route::get('citations/random/{count}', [CitationController::class, 'random']);
Route::post("citations/filter", [CitationController::class, 'filterByLength']);
Route::post('citations/popularite', [CitationController::class, 'popularite']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
