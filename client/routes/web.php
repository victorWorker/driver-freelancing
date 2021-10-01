<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;


use App\Http\Controllers\FrontController;
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

Route::get('clear_cache', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('view:clear');

    dd("Cache is cleared");
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/language/{locale}', function ($locale) {
    session(['my_locale' => $locale]);
   // App::setLocale($locale);
});

Route::group(['middleware' => ['lang']], function() {

	Route::get('client_registration', [FrontController::class, 'index'])->name('client_registration');
	Route::post('step2', [FrontController::class, 'submitStep1'])->name('step2');

	Route::get('driver_registration', [FrontController::class, 'driverRegistration'])->name('driver_registration');
	Route::post('drive_register', [FrontController::class, 'submitDriverRegistration'])->name('drive_register');
	Route::post('shipment_submit', [FrontController::class, 'submitShipmentDetails'])->name('shipment_submit');
});

Route::post('/checkEmailExists',[FrontController::class, 'checkUserEmail'])->name('checkemail');

Route::post('/getshipment',[FrontController::class, 'shipment'])->name('getshipment');
Route::post('/getshipment',[FrontController::class, 'shipment'])->name('getshipment');