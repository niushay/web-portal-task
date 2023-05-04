<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\IndexController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Authentication Routes
Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('loginPage');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');


Route::middleware(AuthMiddleware::class)->group( function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/refreshData', [IndexController::class, 'refreshData'])->name('refreshData');
});
