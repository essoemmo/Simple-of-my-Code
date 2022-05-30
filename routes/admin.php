<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PrivecyController;
use App\Http\Controllers\Admin\RatesController;
use App\Http\Controllers\Admin\RestaurantsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\Admin\UsageController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Website\SectionController;
use App\Http\Controllers\Website\SubSectionController;
use Illuminate\Support\Facades\Route;

         Route::get('admin/home',   [AdminController::class, 'index'])->name('adminhome');
         Route::get('admin',        [LoginController::class, 'showLoginForm'])->name('admin.login');
         Route::post('admin',       [LoginController::class, 'login']);
         Route::get('lang/{local}', [AdminController::class, 'lang'])->name('lang');


 Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
         
         Route::group(['as'=>'admin.'] ,function () {
            Route::resource('rates',    RatesController::class)->except(['show']);
         });
         Route::group(['as'=>'admin.'] ,function () {
            Route::resource('orders',    OrdersController::class)->except(['show']);
         });
         Route::resource('roles',       RoleController::class)->except(['show']);
         Route::resource('aboutus',     AboutController::class)->except(['show']);
         Route::resource('contactus',   ContactController::class)->except(['create', 'edit']);
         Route::resource('terms',       TermsController::class)->except(['show']);
         Route::resource('usages',      UsageController::class)->except(['show']);
         Route::resource('privecy',     PrivecyController::class)->except(['show']);
         Route::resource('faqs',        FaqsController::class)->except(['show']);
         Route::resource('users',       UsersController::class)->except(['show']);
         Route::resource('admins',      AdminsController::class)->except(['show']);
         Route::resource('restaurants', RestaurantsController::class)->except(['show']);
         Route::resource('coupons',     CouponsController::class)->except(['show']);
         Route::resource('amenities',   AmenityController::class)->except(['show']);
         Route::resource('banners',     BannersController::class)->except(['show']);
         Route::resource('sections',    SectionController::class)->except(['show']);
         Route::resource('subsections', SubSectionController::class)->except(['show']);
         
         Route::get('sub_sections/{id}',[SectionController::class, 'allSubSection'])->name('subsections');
         Route::get('setting',          [SettingController::class, 'index'])->name('setting');
         Route::post('setting',         [SettingController::class, 'update'])->name('updatesetting');
         Route::get('useractive',       [UsersController::class, 'UserStatus'])->name('useractive');
         Route::get('restaurantactive', [RestaurantsController::class, 'RestaurantStatus'])->name('restaurantactive');
         Route::get('adminactive',      [AdminsController::class, 'AdminStatus'])->name('adminactive');
         Route::get('banneractive',     [BannersController::class, 'BannerStatus'])->name('banneractive');
         Route::get('amenityactive',    [AmenityController::class, 'AmenityStatus'])->name('amenityactive');
         Route::get('couponactive',     [CouponsController::class, 'CouponStatus'])->name('couponactive');
         Route::get('contactusDetail',  [ContactController::class, 'contactusDetails'])->name('contactusdetails');
         Route::post('logout',          [LoginController::class, 'logout'])->name('admin.logout');
 });
