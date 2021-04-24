<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/dashboard', [\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');
Route::get('/admin/login', [\App\Http\Controllers\DashboardController::class,'Login'])->name('login');
Route::post('/admin/login', [\App\Http\Controllers\DashboardController::class,'PostLogin'])->name('post-login');
Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function (){
    Route::group(['prefix'=>'category'], function (){
        Route::get('index', [\App\Http\Controllers\CategoryController::class,'index'])->name('list-category');
        Route::get('add', [\App\Http\Controllers\CategoryController::class,'add'])->name('add-category');
        Route::get('update/{id}', [\App\Http\Controllers\CategoryController::class,'update'])->name('update-category');
        Route::get('delete/{id}', [\App\Http\Controllers\CategoryController::class,'delete'])->name('delete-category');
        Route::post('update/{id}', [\App\Http\Controllers\CategoryController::class,'save_update'])->name('update-category');
        Route::post('add', [\App\Http\Controllers\CategoryController::class,'save'])->name('save-category');
    });
});
