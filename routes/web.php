<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ListingController::class, 'index']);

Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

Route::get('/listings/{list:title}', [ListingController::class, 'oneList']);

Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

Route::get('/register', [UserController::class, 'create'])->middleware('guest');

Route::get('/login', [UserController::class, 'login'])->middleware('guest');

Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

Route::post('/users', [UserController::class, 'store'])->middleware('auth');

Route::post('/user/logout', [UserController::class, 'logout'])->middleware('auth');

Route::post('/listings/create', [ListingController::class, 'store'])->middleware('auth');

Route::put('/listings/{id}', [ListingController::class, 'update'])->middleware('auth');

Route::delete('/listings/{listing}/delete', [ListingController::class, 'delete'])->middleware('auth');
