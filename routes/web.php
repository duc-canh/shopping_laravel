<?php

use App\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\SliderAdminController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminPermissionController;

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

Route::get('logout',[AdminController::class,'logout']);

Route::get('myName',[AdminController::class,'myName'])->name('admin.myName');

Route::get('home', function () {
    return view('home');
});
Route::prefix('admin')->group(function(){
    Route::prefix('category')->group(function(){
        Route::get('/',[
            'as'=>'admin.category.index',
            'uses'=>'CategoryController@index',
            'middleware'=>'can:list_category',
        ]);
        
        Route::get('add',[CategoryController::class,'create'])->name('admin.category.add')->middleware('can:add_category');
        Route::post('store',[CategoryController::class,'store'])->name('admin.category.store');

        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit')->middleware('can:update_category');
        Route::post('update/{id}',[CategoryController::class,'update'])->name('admin.category.update');

        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('admin.category.delete')->middleware('can:delete_category');
    });

    Route::prefix('menu')->group(function(){
        Route::get('/',[MenuController::class,'index'])->name('admin.menu.index')->middleware('can:list_menu');
        
        Route::get('add',[MenuController::class,'create'])->name('admin.menu.add');
        Route::post('store',[MenuController::class,'store'])->name('admin.menu.store');

        Route::get('edit/{id}',[MenuController::class,'edit'])->name('admin.menu.edit');
        Route::post('update/{id}',[MenuController::class,'update'])->name('admin.menu.update');

        Route::get('delete/{id}',[MenuController::class,'delete'])->name('admin.menu.delete');
    });

   
    Route::prefix('slider')->group(function(){
        Route::get('/',[SliderAdminController::class,'index'])->name('admin.slider.index');
        
        Route::get('add',[SliderAdminController::class,'create'])->name('admin.slider.add');
        Route::post('store',[SliderAdminController::class,'store'])->name('admin.slider.store');

        Route::get('edit/{id}',[SliderAdminController::class,'edit'])->name('admin.slider.edit');
        Route::post('update/{id}',[SliderAdminController::class,'update'])->name('admin.slider.update');

        Route::get('delete/{id}',[SliderAdminController::class,'delete'])->name('admin.slider.delete');
    });

    Route::prefix('setting')->group(function(){
        Route::get('/',[AdminSettingController::class,'index'])->name('admin.setting.index');
        
        Route::get('add',[AdminSettingController::class,'create'])->name('admin.setting.add');
        Route::post('store',[AdminSettingController::class,'store'])->name('admin.setting.store');

        Route::get('edit/{id}',[AdminSettingController::class,'edit'])->name('admin.setting.edit');
        Route::post('update/{id}',[AdminSettingController::class,'update'])->name('admin.setting.update');

        Route::get('delete/{id}',[AdminSettingController::class,'delete'])->name('admin.setting.delete');
    });

    Route::prefix('users')->group(function(){
        Route::get('/',[AdminUserController::class,'index'])->name('admin.user.index');
        
        Route::get('add',[AdminUserController::class,'create'])->name('admin.user.add');
        Route::post('store',[AdminUserController::class,'store'])->name('admin.user.store');

        Route::get('edit/{id}',[AdminUserController::class,'edit'])->name('admin.user.edit');
        Route::post('update/{id}',[AdminUserController::class,'update'])->name('admin.user.update');

        Route::get('delete/{id}',[AdminUserController::class,'delete'])->name('admin.user.delete');
    });
    Route::prefix('role')->group(function(){
        Route::get('/',[AdminRoleController::class,'index'])->name('admin.role.index');
        Route::get('add',[AdminRoleController::class,'create'])->name('admin.role.add');
        Route::post('store',[AdminRoleController::class,'store'])->name('admin.role.store');

        Route::get('edit/{id}',[AdminRoleController::class,'edit'])->name('admin.role.edit');
        Route::post('update/{id}',[AdminRoleController::class,'update'])->name('admin.role.update');

        Route::get('delete/{id}',[AdminRoleController::class,'delete'])->name('admin.role.delete');
    });
    Route::prefix('permission')->group(function(){
        // Route::get('/',[AdminRoleController::class,'index'])->name('admin.permission.index');
        Route::get('add',[AdminPermissionController::class,'create'])->name('admin.permission.add');
        Route::post('store',[AdminPermissionController::class,'store'])->name('admin.permission.store');

        // Route::get('edit/{id}',[AdminRoleController::class,'edit'])->name('admin.permission.edit');
        // Route::post('update/{id}',[AdminRoleController::class,'update'])->name('admin.permission.update');

        // Route::get('delete/{id}',[AdminRoleController::class,'delete'])->name('admin.permission.delete');
    });
});
