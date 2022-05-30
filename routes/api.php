<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\QrCodeOrderController;
use App\Http\Controllers\API\RateController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\RestaurantController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\TakeOrderController;
use Illuminate\Support\Facades\Route;

    Route::post('register',            [AuthController::class,'Register']); //register
    Route::post('verify',              [AuthController::class,'verify']); //verify
    Route::post('reset',               [AuthController::class,'resetCode']); //reset_code
    Route::post('login',               [AuthController::class,'login']); //login
    Route::post('update-password',     [AuthController::class,'updatePassword']); //update password

    Route::get('setting',              [SettingController::class,'AllSetting']); //setting
    Route::post('contactus',           [SettingController::class,'ContactUs']); //contact
    Route::get('all-setting',          [SettingController::class,'AllSetting']); //settings

    Route::get('restaurants',          [RestaurantController::class,'Restaurants']); // restaurants
    Route::post('restaurant-products', [RestaurantController::class,'RestaurantProducts']); //restaurant-products
    Route::post('restaurant-details',  [RestaurantController::class,'Restaurant']); // details
    Route::post('restaurant-qr',       [RestaurantController::class,'RestaurantQr']); //restaurant-amenities
    Route::get('search',               [RestaurantController::class,'Search']); // search
    Route::get('tables',               [RestaurantController::class,'tables']); //tables

    Route::post('product-details',     [ProductController::class,'ProductDetails']); // product

Route::middleware('auth:api')->group( function () {
    Route::get('logout',                [AuthController::class,'logout']); // logout
    Route::post('add-rate',             [RateController::class,'addRate']); // user
    Route::get('user-profile',          [AuthController::class,'UserProfile']); // profile
    Route::post('update-profile',       [AuthController::class,'UpdateProfile']); // update profile
    Route::post('update-password-user', [AuthController::class,'UpdateUserPassword']); //update password
    Route::post('update-location',      [AuthController::class,'UpdateLocation']); //update location

    Route::post('check-take-order',     [OrderController::class,'CheckTakeOrder']); // check order
    Route::post('add-order',            [OrderController::class,'AddOrder']); // add order
    Route::get('active-orders',         [OrderController::class,'ActiveOrders'])->name('activeorders'); //active
    Route::get('history-orders',        [OrderController::class,'HistoryOrders'])->name('historyorders'); //history
    Route::post('discount',             [OrderController::class,'discountCoupon']); //discount
    Route::post('cancel-order',         [OrderController::class,'CancelOrder']); //cancel

    Route::post('add-to-cart',          [CartController::class,'addToCart']); // add to cart
    Route::get('small-cart-details',    [CartController::class,'SmallCartDetails']); // small
    Route::get('cart-details',          [CartController::class,'CartDetails']); // Cart
    Route::get('delete-carts',          [CartController::class,'DeleteCarts']); // Cart
    Route::post('update-cart',          [CartController::class,'UpdateQty']); // Cart
    Route::post('delete-cart',          [CartController::class,'DeleteCart']); // Cart

    Route::post('add-reservation',      [ReservationController::class,'AddReservation']); //discount
    Route::post('update-reservation',   [ReservationController::class,'UpdateReserv']); //discount
    Route::post('cancel-reservation',   [ReservationController::class,'CancelReserv']); //cancel
    Route::post('add-invite',           [ReservationController::class,'AddInvite']); //discount
    Route::post('accept-invite',        [ReservationController::class,'AcceptInvite']); //discount
    Route::get('invites',               [ReservationController::class,'Invitions']); //discount
    Route::post('invites-resrves',      [ReservationController::class,'InvitesResrve']); //discount
    Route::post('invites-details',      [ReservationController::class,'myInviteDetails']); //discount
    
    Route::get('notifications',         [NotificationController::class,'userNotifications']);
    Route::post('delete-notification',  [NotificationController::class,'DeleteNotification']);
});