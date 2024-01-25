<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\http\Controllers\postsController;


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

Route::get('/resource', [userController::class, 'getResource']);
Route::post('/resource', [userController::class, 'createResource']);
Route::put('/resource/{id}', [userController::class, 'updateResource']);
Route::delete('/resource/{id}', [userController::class, 'deleteResource']);

//POSTS
Route::get('/posts', [postsController::class, 'getAllPosts']);
Route::post('/posts', [postsController::class, 'makePost']);
Route::post('/posts/{id}', [postsController::class, 'deletePost']);
