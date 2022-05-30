<?php

use App\Http\Controllers\API\AuthRestaurantController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\RestaurantController;
use App\Http\Controllers\API\SettingController;
use Illuminate\Support\Facades\Route;

        Route::post('register',        [AuthRestaurantController::class,'Register']); //register
        Route::post('verify',          [AuthRestaurantController::class,'verify']); //verify
        Route::post('reset',           [AuthRestaurantController::class,'resetCode']); //reset_code
        Route::post('login',           [AuthRestaurantController::class,'login']); //login
        Route::post('update-password', [AuthRestaurantController::class,'UpdatePassword']); //update password
        Route::get('tables',           [RestaurantController::class,'tables']); //tables
        Route::get('all-setting',      [SettingController::class,'AllSetting']); //settings
        Route::get('amenities',        [RestaurantController::class,'amenities']); //tables
        Route::post('contactus',       [SettingController::class,'ContactUs']); //contact

    Route::middleware('auth:restaurant-api')->group( function () {
        Route::get('restaurant-profile',          [AuthRestaurantController::class,'RestaurantProfile']); // profile
        Route::get('logout',                      [AuthRestaurantController::class,'logout']); // logout
        Route::post('update-profile',             [AuthRestaurantController::class,'UpdateProfile']); // update profile
        Route::post('update-password-restaurant', [AuthRestaurantController::class,'UpdateUserPassword']); //update password
        Route::get('restaurant-details',          [RestaurantController::class,'Restaurant']); // details
        Route::post('approved',                   [OrderController::class,'AproveOrder']); // details
        Route::post('completed',                  [OrderController::class,'CompleteOrder']); // details
        Route::post('confirmed',                  [OrderController::class,'ConfirmOrder']); // details
        Route::post('Rejected',                   [OrderController::class,'RejectOrder']); // details
        Route::post('active-orders-restaurant',   [OrderController::class,'ActiveOrdersRestaurant'])->name('activeordersrestaurant'); //active
        Route::post('history-orders-restaurant',  [OrderController::class,'HistoryOrdersRestaurant'])->name('historyordersrestaurant'); //history
        Route::get('notifications',               [NotificationController::class,'restNotifications']);
        Route::post('delete-notification',        [NotificationController::class,'DeleteResNotification']);
    });