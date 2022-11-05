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

Route::get('/listings/create', [ListingController::class, 'create']);

Route::post('/listings/create', [ListingController::class, 'store']);

Route::put('/listings/{id}', [ListingController::class, 'update']);

Route::get('/listings/{list:title}', [ListingController::class, 'oneList']);

Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

Route::delete('/listings/{listing}/delete', [ListingController::class, 'delete']);

Route::get('/register', [UserController::class, 'create']);
