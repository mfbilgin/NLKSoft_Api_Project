<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login')->middleware();
    Route::post('login', [AuthController::class, 'post_login'])->name('post.login');

    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'post_register'])->name('post.register');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});


Route::get('/', [ProductController::class, 'index'])->name('product.index');

Route::get('products', [ProductController::class, 'index'])->name('product.index');
Route::get('products/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('products', [ProductController::class, 'create'])->name('product.create');
Route::post('products', [ProductController::class, 'store'])->name('product.store');

Route::get('products/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('products/{id}', [ProductController::class, 'update'])->name('product.update');

Route::delete('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
