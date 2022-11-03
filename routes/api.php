<?php

use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AuthDropdownController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\HomeKidController;
use App\Http\Controllers\API\HomeSellerController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\OrganizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



    Route::post('register',        [AuthController::class,'Register']); //register
    Route::post('verify',          [AuthController::class,'verify']); //verify
    Route::post('reset',           [AuthController::class,'resetCode']); //reset_code
    Route::post('login',           [AuthController::class,'login']); //login
    Route::post('update-password', [AuthController::class,'updatePassword']); //update password
    Route::get('cities',           [AuthDropdownController::class,'cities']); //cities
    Route::get('languages',        [AuthDropdownController::class,'langs']); //langs
    Route::get('nationals',        [AuthDropdownController::class,'nationals']); //nationals
    Route::get('relations',        [AuthDropdownController::class,'relations']); //relations
    Route::get('settings',         [\App\Http\Controllers\API\SettingController::class,'index']); //relations
    Route::post('scan',            [\App\Http\Controllers\API\KidController::class,'scan']); //relations


Route::middleware(['auth:api' , 'bindings'])->group( function () {
    //SELLER
    Route::get('home-seller',                 [HomeSellerController::class, 'index']); // home
    Route::post('post-order',                 [OrderController::class, 'post']); // post order
    Route::get('order-seller/{id}',           [OrderController::class, 'order']); // get order
    Route::get('get-kid/{id}',                [HomeSellerController::class, 'getKid']); // view getKid
    Route::post('post-account',               [AccountController::class, 'post']); // post order
    Route::get('draw-request',                [HomeSellerController::class, 'drawRequest']); // get account

    //KID
    Route::get('home-kid',                    [HomeKidController::class, 'index']); // home
    Route::get('order-kid/{id}',              [OrderController::class, 'order_kid']); // get order

    //Organization
    Route::post('organization-scan-kids',     [OrganizationController::class, 'scan']); // organization-scan-kids
    Route::get('organization-home',          [OrganizationController::class, 'home']); // organization-home
    Route::get('organization-attendance',      [OrganizationController::class, 'attendance']); // organization-attendance
    Route::get('organization-leave',          [OrganizationController::class, 'leave']); // organization-leave
    Route::get('organization-attendanceLeave',          [OrganizationController::class, 'attendanceLeave']); // organization-attendance and Leave
    
    /*                  KIDS ROUTES                               */
    Route::get('kids' ,                        [\App\Http\Controllers\API\KidController::class , 'index']);
    Route::get('kids/{kid}' ,                  [\App\Http\Controllers\API\KidController::class , 'show']);
    Route::post('kids' ,                       [\App\Http\Controllers\API\KidController::class , 'store']);
    Route::post('kids/update/{kid}' ,                       [\App\Http\Controllers\API\KidController::class , 'update']);
    Route::post('kids/charges/{kid}' ,         [\App\Http\Controllers\API\KidController::class , 'charge']);
    Route::get('kids/charges/{kid}' ,               [\App\Http\Controllers\API\KidController::class , 'chargeHistory']);
    Route::get('kids/orders/{kid}' ,               [\App\Http\Controllers\API\KidController::class , 'orders']);
    Route::get('kids/scans/{kid}' ,               [\App\Http\Controllers\API\KidController::class , 'scans']);

    /*    PARENT ROUTES        */
    Route::post('parent/update-profile',[\App\Http\Controllers\API\ParentController::class,'updateProfile']);
    Route::get('parent/transactions' , [\App\Http\Controllers\API\ParentController::class , 'transactions']);

    Route::get('notifications',         [NotificationController::class,'userNotifications']);
    Route::post('delete-notification',  [NotificationController::class,'DeleteNotification']);
});
