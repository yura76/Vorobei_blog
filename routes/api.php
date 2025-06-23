<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('blog/posts', [\App\Http\Controllers\Api\Blog\PostController::class, 'index']);
Route::get('blog/post/{id}', [\App\Http\Controllers\Api\Blog\PostController::class, 'show']);

Route::get('/blog/categories', [\App\Http\Controllers\Api\Blog\CategoryController::class, 'index']);
Route::delete('/blog/category/{id}', [\App\Http\Controllers\Api\Blog\CategoryController::class, 'delete']);
Route::get('/blog/category/create', [\App\Http\Controllers\Api\Blog\CategoryController::class, 'create']);
Route::post('/blog/category/create', [\App\Http\Controllers\Api\Blog\CategoryController::class, 'store']);
Route::put('/blog/category/edit/{id}', [\App\Http\Controllers\Api\Blog\CategoryController::class, 'update']);



