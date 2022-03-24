<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

Route::get('admin', [AdminController::class,'loginAdmin']);
Route::post('admin', [AdminController::class,'postLoginAdmin'])->name('admin.postLogin');

Route::get('home', function () {
    return view('home');
});
Route::prefix('admin')->group(function(){
    Route::prefix('category')->group(function(){
        Route::get('/',[CategoryController::class,'index'])->name('admin.category.index');
        
        Route::get('add',[CategoryController::class,'create'])->name('admin.category.add');
        Route::post('store',[CategoryController::class,'store'])->name('admin.category.store');

        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');
        Route::post('update/{id}',[CategoryController::class,'update'])->name('admin.category.update');

        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('admin.category.delete');
    });

    Route::prefix('menu')->group(function(){
        Route::get('/',[MenuController::class,'index'])->name('admin.menu.index');
        
        Route::get('add',[MenuController::class,'create'])->name('admin.menu.add');
        Route::post('store',[MenuController::class,'store'])->name('admin.menu.store');

        Route::get('edit/{id}',[MenuController::class,'edit'])->name('admin.menu.edit');
        Route::post('update/{id}',[MenuController::class,'update'])->name('admin.menu.update');

        Route::get('delete/{id}',[MenuController::class,'delete'])->name('admin.menu.delete');
    });

    Route::prefix('product')->group(function(){
        Route::get('/',[ProductController::class,'index'])->name('admin.product.index');
        
        Route::get('add',[ProductController::class,'create'])->name('admin.product.add');
        Route::post('store',[ProductController::class,'store'])->name('admin.product.store');

        Route::get('edit/{id}',[ProductController::class,'edit'])->name('admin.product.edit');
        Route::post('update/{id}',[ProductController::class,'update'])->name('admin.product.update');

        Route::get('delete/{id}',[ProductController::class,'delete'])->name('admin.product.delete');
    });
});
