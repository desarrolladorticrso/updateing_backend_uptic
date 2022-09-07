<?php

use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function(){
    Route::post('/login','login');
    Route::post('/user','register');
});

Route::middleware('auth:sanctum')->group(function(){

    Route::controller(UserController::class)->group(function(){
        Route::post('/logout','logout');
    });

    Route::controller(PermisoController::class)->group(function(){
        Route::get('/permissions', 'index')->name('permission.index');
        Route::get('/permission/{permission}', 'show')->name('permission.show');
        Route::put('/permission/{permission}', 'update')->name('permission.update');
        Route::post('/permission', 'store')->name('permission.store');
        Route::post('/permission/{permission}', 'destroy')->name('permission.destroy');
        Route::delete('/permission/{permission}', 'forceDestroy')->name('permission.forceDestroy');
    });

    Route::controller(RolController::class)->group(function(){
        Route::get('/roles','index');
        Route::get('/role/{role}','show');
        Route::put('/role/{role}','update');
        Route::post('/role','store');
        Route::post('/role/{role}','destroy');
        Route::delete('/role/{role}','forceDestroy');
    });

});



