<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TaskController;
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
    Route::get('/contact-admin', [MessageController::class, 'index'])->name('contact-admin');
    Route::view('/create-message', 'pages.message')->name('create-message');
    Route::post('/send-message', [MessageController::class, 'store'])->name('send-message');

    Route::controller(TaskController::class)->prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/add-new-task', 'create')->name('create');
        Route::post('/submit-new-task', 'store')->name('store');
    });
});

Route::controller(TaskController::class)->prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/{task}/edit-task', 'edit')->name('edit')->middleware('auth');
    Route::put('/{task}/update-task', 'update')->name('update')->middleware('auth');
    Route::delete('/{task}/delete-task', 'delete')->name('delete')->middleware('auth');
});


Route::middleware('auth', 'role:admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [Admin::class, 'index'])->name('admin.index');
        Route::get('/manage-tasks', [Admin::class, 'tasks'])->name('manage-tasks');
        Route::get('/manage-users', [Admin::class, 'manageUsers'])->name('manage-users');
        Route::post('/manage-users/update-status', [Admin::class, 'updateStatus'])->name('update-status');

        Route::name('admin.')->group(function () {
            Route::controller(CategoryController::class)->prefix('categories')->name('category.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::put('/{category}/update-status', 'updateStatus')->name('update-status');
                Route::delete('/{category}/delete', 'delete')->name('delete');
            });
        });
    });

});

require __DIR__.'/auth.php';
