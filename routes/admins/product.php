<?php

use App\Http\Controllers\ProductController;
Route::prefix('admin')->middleware('can:admin_access')->group(function(){
    Route::prefix('product')->group(function(){
        Route::get('/',[ProductController::class,'index'])->name('admin.product.index')->middleware('can:list_product');
        
        Route::get('add',[ProductController::class,'create'])->name('admin.product.add')->middleware('can:add_product');
        Route::post('store',[ProductController::class,'store'])->name('admin.product.store');

        Route::get('edit/{id}',[ProductController::class,'edit'])->name('admin.product.edit')->middleware('can:edit_product,id');
        Route::post('update/{id}',[ProductController::class,'update'])->name('admin.product.update');

        Route::get('delete/{id}',[ProductController::class,'delete'])->name('admin.product.delete')->middleware('can:delete_product');
    });

});

