<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'store']);

Route::resource('/siswa', SiswaController::class);

Route::get('/users', [UserController::class, 'index']);
Route::put('/users/{userId}/make-admin', [UserController::class, 'makeAdmin']);