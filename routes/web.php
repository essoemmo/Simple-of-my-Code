<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('langhome/{local}', [HomeController::class, 'langHome'])->name('langhome');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faqs'])->name('faq');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contactUs'])->name('contact');
Route::post('/storecontact', [App\Http\Controllers\HomeController::class, 'storeContact'])->name('storecontact');

Route::get('command', function () {
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
});

// Route::get('/foo', function () {
//     Artisan::call('storage:link');
// });

Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path($filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
