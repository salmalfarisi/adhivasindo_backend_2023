<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\APIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
 
Route::post('/register', [LoginController::class, 'Register']);
Route::post('/login', [LoginController::class, 'Login']);

Route::middleware(['token'])->group(function () {
	Route::get('/logout', [LoginController::class, 'Logout']);
	Route::post('/find', [APIController::class, 'Finddata']);
});
