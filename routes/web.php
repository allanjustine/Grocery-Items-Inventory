<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;

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

Route::get('/', [SiteController::class, 'home']);

Route::get('/login', [SiteController::class, 'loginForm'])->name('login');
Route::post('/login',[SiteController::class, 'login']);
Route::post('/register',[SiteController::class, 'register']);
Route::get('/register',[SiteController::class, 'registerForm']);

Route::group(['middleware' => 'auth'], function(){

    Route::post('/logout', [SiteController::class, 'logout']);

    Route::get('/users/create',[UserController::class,'create']);
    Route::post('/users',[UserController::class, 'store']);
    Route::get('/users', [UserController::class,'index']);

    Route::get('/customers/create', [CustomerController::class,'create']);
    Route::get('/customers/edit/{id}', [CustomerController::class,'edit']);
    Route::get('/customers/delete/{id}', [CustomerController::class,'delete']);
    Route::get('/customers/view/{id}', [CustomerController::class,'view']);
    Route::delete('/customers/{customer}', [CustomerController::class,'destroy']);
    Route::put('/customers/{customer}', [CustomerController::class,'update']);
    Route::get('/customers', [CustomerController::class,'index']);
    Route::post('/customers', [CustomerController::class,'store']);

    Route::get('/items/create', [ItemCategoryController::class,'create']);
    Route::get('/items/edit/{id}', [ItemCategoryController::class,'edit']);
    Route::put('/items/{itemCategory}', [ItemCategoryController::class,'update']);
    Route::get('/items/delete/{id}', [ItemCategoryController::class,'delete']);
    Route::delete('/items/{itemCategory}', [ItemCategoryController::class,'destroy']);
    Route::get('/items', [ItemCategoryController::class,'index']);
    Route::post('/items', [ItemCategoryController::class,'store']);
});


