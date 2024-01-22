<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


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

Route::get('/resource', [ApiController::class, 'getResource']);
Route::post('/resource', [ApiController::class, 'createResource']);
Route::put('/resource/{id}', [ApiController::class, 'updateResource']);
Route::delete('/resource/{id}', [ApiController::class, 'deleteResource']);
