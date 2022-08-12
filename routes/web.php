<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\MessageController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [Dashboard::class, 'index'])->name('dashboard');
    Route::view('/create-message', 'pages.message')->name('create-message');
    Route::post('/send-message', [MessageController::class, 'store'])->name('send-message');
});

require __DIR__.'/auth.php';
