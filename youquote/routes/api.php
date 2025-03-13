<?php

use App\Http\Controllers\CitationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('citations',CitationController::class);
Route::get('citations/random/{count}', [CitationController::class, 'random']);
Route::post("citations/filter", [CitationController::class, 'filterByLength']);
