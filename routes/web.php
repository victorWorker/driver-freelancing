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

// Route::get('/', function () {
//     return view('master');
// });
Route::get('/clear-cache', function() {
     Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";
});

Route::get('login','dashboard\HomeController@login');

Route::get('transpoter/bidlist/{id}','frontdash\BidController@get_bid_by_shipment_id');

Route::get('/admin/users/sendcancelemail','dashboard\UserController@sendCancelAccountEmail');

Route::get('/enduser/bids/count/{id}','userfront\ShipmentController@total_bids');

Route::get('/dash/shipment/view/Clientlist/{id}','dashboard\UserController@get_user_by_id');

Route::get('/profiles/transporters/{id}','userfront\UserController@getTransporter');

Route::get('dash/','dashboard\HomeController@index');

Route::get('/admin/dash/count/','dashboard\HomeController@count_all');

Route::get('dash/{path}','dashboard\HomeController@index')->where( 'path', '([A-z\d\-\/_.]+)?');

Route::get('transporter/dashboard','frontdash\HomeController@index');
Route::get('transporter/dashboard/{path}','frontdash\HomeController@index')->where( 'path', '([A-z\d\-\/_.]+)?');

Route::get('user/dashboard','frontdash\HomeController@index');
Route::get('user/dashboard/{path}','frontdash\HomeController@index')->where( 'path', '([A-z\d\-\/_.]+)?');


// Standard pages
Route::get('/aboutus', function() {
  return view('standard.aboutus');
});
Route::get('/search', function() {
  return view('standard.search');
});
Route::get('{path}','userfront\HomeController@index')->where( 'path', '([A-z\d\-\/_.]+)?');


Route::get('client_registration','frontdash\HomeController@client_registration');

Route::get('/sendmessage', 'frontdash\HomeController@sendCustomMessage');
