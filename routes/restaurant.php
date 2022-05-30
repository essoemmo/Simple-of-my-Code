<?php

use App\Http\Controllers\Restaurant\RatesController;
use App\Http\Controllers\Restaurant\CategoryController;
use App\Http\Controllers\Restaurant\LoginController;
use App\Http\Controllers\Restaurant\OrdersController;
use App\Http\Controllers\Restaurant\PhotosController;
use App\Http\Controllers\Restaurant\ProductsController;
use App\Http\Controllers\Restaurant\RestaurantController;
use App\Http\Controllers\Restaurant\SettingController;
use App\Http\Controllers\Restaurant\TypesController;
use Illuminate\Support\Facades\Route;

    Route::get('restaurant/home', [RestaurantController::class, 'index'])->name('restauranthome');
    Route::get('restaurant',      [LoginController::class, 'showLoginForm'])->name('restaurant.login');
    Route::post('restaurant',     [LoginController::class, 'login'])->name('restaurantLogin');
    Route::get('Reslang/{local}',    [RestaurantController::class, 'lang'])->name('Reslang');


 Route::group(['prefix' => 'restaurant', 'middleware' => ['auth:restaurant']], function () {
    Route::resource('products',      ProductsController::class)->except(['show']);
    Route::resource('categories',    CategoryController::class)->except(['show']);
    Route::resource('orders',        OrdersController::class)->except(['show']);
    Route::resource('types',         TypesController::class)->except(['show']);
    Route::resource('rates',         RatesController::class)->except(['show']);
    Route::resource('photos',        PhotosController::class)->except(['show']);
    
    Route::get('setting',           [SettingController::class, 'index'])->name('restaurantsetting');
    Route::post('setting',          [SettingController::class, 'update'])->name('updaterestaurantsetting');
    Route::get('gettypes',          [ProductsController::class, 'getTypes'])->name('gettypes');
    Route::get('product_types/{id}',[ProductsController::class, 'allTypes'])->name('protypes');
    Route::get('categoryactive',    [CategoryController::class, 'CategoryStatus'])->name('categoryactive');
    Route::get('productactive',     [ProductsController::class, 'ProductStatus'])->name('productactive');
    Route::post('logout',           [LoginController::class, 'logout'])->name('restaurant.logout');
    Route::get('download',          [SettingController::class, 'fileDownload'])->name('download');
 });