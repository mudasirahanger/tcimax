<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SalesController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//auth
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');

// users
Route::get('/users/{page}/{limit}/{role_id}', [UsersController::class, 'users'])->middleware('auth:sanctum');
Route::post('/addbulkusers', [UsersController::class, 'addbulkusers'])->middleware('auth:sanctum');

// sales
Route::post('/addbulksales', [SalesController::class, 'addbulksales'])->middleware('auth:sanctum');
Route::post('/addsales', [SalesController::class, 'addsales'])->middleware('auth:sanctum');
Route::get('/getSalesQueue/{page}/{limit}/{type}', [SalesController::class, 'getSalesQueue'])->middleware('auth:sanctum');