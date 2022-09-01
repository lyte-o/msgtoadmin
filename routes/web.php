<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\CategoryController;
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

Route::middleware('auth','active', 'role:user')->group(function () {
    Route::get('/', [Dashboard::class, 'index'])->name('dashboard');
    Route::view('/create-message', 'pages.message')->name('create-message');
    Route::post('/send-message', [MessageController::class, 'store'])->name('send-message');
});

Route::middleware('auth', 'role:admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [Admin::class, 'index'])->name('admin.index');
        Route::get('/manage-users', [Admin::class, 'manageUsers'])->name('manage-users');
        Route::post('/manage-users/update-status', [Admin::class, 'updateStatus'])->name('update-status');

        Route::name('admin.')->group(function () {
            Route::controller(CategoryController::class)->prefix('categories')->name('category.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::put('/{category}/update-status', 'updateStatus')->name('update-status');
            });
        });
    });

});

require __DIR__.'/auth.php';
