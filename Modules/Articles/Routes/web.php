<?php

use Modules\Articles\Http\Controllers\ArticlesController;
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

Route::get('/', [ArticlesController::class, 'index'])->name('articles');
Route::prefix('articles')->group(function () {
    Route::get('/create', [ArticlesController::class, 'create'])->name('articles.create');
    Route::post('/', [ArticlesController::class, 'store'])->name('articles.store');
    Route::get('/edit/{id}', [ArticlesController::class, 'edit'])->name('articles.edit');
    Route::post('/{id}', [ArticlesController::class, 'update'])->name('articles.update');
    Route::delete('/{id}', [ArticlesController::class, 'destroy'])->name('articles.destroy');
});
