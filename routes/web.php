<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Models\Category;
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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->name('admin.')->group(function () {

    // For  admin dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // for categories
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::put('update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('destroy/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
    // for blogs
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', [BlogsController::class, 'index'])->name('index');
        Route::get('create', [BlogsController::class, 'create'])->name('create');
        Route::post('store', [BlogsController::class, 'store'])->name('store');
        Route::get('edit/{blog}', [BlogsController::class, 'edit'])->name('edit');
        Route::get('show/{blog}', [BlogsController::class, 'show'])->name('show');
        Route::put('update/{blog}', [BlogsController::class, 'update'])->name('update');
        Route::delete('destroy/{blog}', [BlogsController::class, 'destroy'])->name('destroy');
    });
});
