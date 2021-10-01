<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Broadcast::routes(['middleware' => ['auth:sanctum']]);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'custom.auth.roles'])->group(function() {
    Route::resource('/admin/users', 'dashboard\UserController');
    Route::get('/admin/users/get/users', 'dashboard\UserController@getUsers');
    Route::get('/admin/users/get/user/{id}', 'dashboard\UserController@getUser');
    Route::get('/admin/users/get/transporter/{id}', 'dashboard\UserController@getTransporter');
    Route::get('/admin/users/get/transporters', 'dashboard\UserController@getTransporters');
    Route::get('/admin/users/get/transporters/nodocument', 'dashboard\UserController@getTransportersNoDocuments');
    Route::patch('/admin/users/ban/{id}','dashboard\UserController@banUser');
    Route::patch('/admin/users/setusersms/{id}','dashboard\UserController@setUserSms');
    Route::patch('/admin/users/unsetusersms/{id}','dashboard\UserController@unsetUserSms');
    Route::patch('/admin/users/approve/{id}','dashboard\UserController@approveUser');
    Route::post('/admin/users/search','dashboard\UserController@searchUser');
    Route::post('/admin/users/mail', 'dashboard\UserController@sendEmail');
    Route::post('/admin/update/badge', 'dashboard\UserController@updateUserBadge');



    
    Route::resource('/admin/shipments', 'dashboard\ShipmentController');
     Route::post('/admin/shipments/upload', 'dashboard\ShipmentController@uploadImage');
    Route::get('/admin/shipments/get/shipment/{id}', 'dashboard\ShipmentController@getShipment');
    Route::get('/admin/shipments/fetch/expired', 'dashboard\ShipmentController@getExpiredShipments');
    Route::get('/admin/shipments/fetch/jobs', 'dashboard\ShipmentController@getAllShipments');
    Route::get('/admin/shipments/get/bids/{id}', 'dashboard\ShipmentController@getBids');
    Route::patch('/admin/shipments/suspend/bid/{id}', 'dashboard\ShipmentController@suspendBid');
    Route::patch('/admin/shipments/complete/shipment/{id}', 'dashboard\ShipmentController@markAsComplete');
    Route::patch('admin/transactions/approve/{id}', 'dashboard\TransactionController@paymentApprove');
    Route::patch('/admin/shipments/update_shipment/{id}', 'dashboard\ShipmentController@update');
    Route::patch('/admin/shipments/delete/shipment/{id}', 'dashboard\ShipmentController@destroy');
    Route::patch('/admin/shipments/activate/bid/{id}', 'dashboard\ShipmentController@activateBid');
    Route::patch('/admin/shipments/update_shipments/{id}', 'dashboard\ShipmentController@updateShipment');
    Route::patch('/admin/shipments/update/bid', 'dashboard\ShipmentController@updateBid');
    Route::patch('/admin/shipments/add/prices', 'dashboard\ShipmentController@addPrices');


    Route::resource('/admin/jobs', 'dashboard\ShipmentController');
    Route::get('/admin/jobs/get/bids/{id}', 'dashboard\JobsControllers@getBids');
    Route::get('/admin/jobs/get/job/{id}', 'dashboard\JobsControllers@getShipment');


    Route::resource('/admin/transactions', 'dashboard\TransactionController');

    Route::resource('/admin/categories', 'dashboard\CategoryController');

    Route::patch('/transporter/update/profile', 'frontdash\HomeController@updateUserProfile');
    Route::post('/transporter/document/upload', 'frontdash\HomeController@uploadDocuments');
    Route::post('/transporter/document/uploadprofile', 'frontdash\ShipmentController@uploadImage');
    Route::post('/transporter/documents/add', 'frontdash\HomeController@addTransporterDocuments');
    Route::get('/transporter/dashboard/data', 'frontdash\HomeController@getTransporterDashData');
    Route::resource('/transporter/bids', 'frontdash\BidController');  
    Route::get('/transporter/get/bids/{id}', 'frontdash\BidController@get_bid_by_shipment_id');
    Route::get('/transporter/bids/fetch/open', 'frontdash\BidController@getOpenBids');
    Route::get('/transporter/bids/fetch/oubids', 'frontdash\BidController@getOuBids');
    Route::get('/transporter/bids/fetch/awarded', 'frontdash\BidController@getAwardedBids');
    Route::get('/transporter/bids/fetch/expired', 'frontdash\BidController@getExpiredBids');
    Route::get('/transporter/bids/fetch/completed', 'frontdash\BidController@getCompletedBids');
    Route::patch('/transporter/bids/promote/{id}', 'frontdash\BidController@promoteBid');
    Route::patch('/transporter/bids/updatebid/{id}', 'frontdash\BidController@updatebid');
    Route::get('/transporter/transactions', 'frontdash\TransactionController@getTransporterTransactions');
    Route::get('/transporter/transaction/last/subscription', 'frontdash\TransactionController@getPreviousSubscriptionTransaction');
    Route::get('/transporter/generate/guia/{id}', 'frontdash\ShipmentController@getGuiaData');
   
    Route::patch('/user/update/profile', 'frontdash\HomeController@updateUserProfile');
    Route::post('/user/document/uploadprofile', 'frontdash\ShipmentController@uploadImage');
    Route::patch('/user/shipments/markcompleteship/{id}', 'frontdash\ShipmentController@markAsComplete');
    Route::patch('/user/shipments/sendcoupon', 'frontdash\ShipmentController@getCouponCode');
    Route::get('/user/categories', 'dashboard\CategoryController@getCategories');
    Route::get('/user/dashboard/data', 'frontdash\HomeController@getUserDashData');
    Route::resource('/user/shipments', 'frontdash\ShipmentController');
    Route::post('/user/shipments/upload', 'frontdash\ShipmentController@uploadImage');
    Route::get('/user/shipments/fetch/open', 'frontdash\ShipmentController@getOpenShipments');
    Route::get('/user/shipments/fetch/awarded', 'frontdash\ShipmentController@getAwardedShipments');
    Route::get('/user/shipments/fetch/expired', 'frontdash\ShipmentController@getExpiredShipments');
    Route::get('/user/shipments/fetch/completed', 'frontdash\ShipmentController@getCompletedShipments');
    Route::get('/user/shipments/get/{id}', 'frontdash\ShipmentController@getUserShipment');
    Route::get('/user/shipments/get/bid/{id}', 'frontdash\ShipmentController@getUserShipmentBidData');
    Route::get('/user/shipments/get/bids/{id}', 'frontdash\ShipmentController@getUserShipmentBids');
    Route::patch('/user/shipments/actualcontact/{id}', 'frontdash\ShipmentController@updateActualContact');
    Route::post('/user/shipments/review', 'frontdash\ShipmentController@addReview');
    Route::post('/user/subject/create', 'frontdash\MessageController@createSubject');

    Route::post('/transporter/submit/bid', 'userfront\ShipmentController@submitBid');
    
     Route::post('/transporter/shipments/review', 'frontdash\ShipmentController@addDriverReview');
    Route::post('/transporter/send/message', 'frontdash\MessageController@sendMessage');
    Route::post('/transporter/get/messages', 'frontdash\MessageController@getMessages');
    Route::get('/transporter/get/subjects', 'frontdash\MessageController@getSubjects');
    Route::post('/transporter/subject/create', 'frontdash\MessageController@createdriverSubject');
    Route::patch('/transporter/read/messages', 'frontdash\MessageController@setMessagesRead');
    Route::get('/transporter/unread/get', 'frontdash\MessageController@getUnreadMessages');

    Route::post('/user/send/message', 'frontdash\MessageController@sendMessage');
    Route::get('/user/unread/get', 'frontdash\MessageController@getUnreadMessages');
    Route::patch('/user/read/messages', 'frontdash\MessageController@setMessagesRead');
    Route::post('/user/get/messages', 'frontdash\MessageController@getMessages');
    Route::get('/user/get/subjects', 'frontdash\MessageController@getUserSubjects');
});

Route::get('/driver/bid/{id}', 'frontdash\BidController@get_bid_data');
Route::get('/enduser/listings/{id}', 'userfront\ShipmentController@shipmentwithbid');
Route::get('enduser/listings/auto/{id}', 'userfront\ShipmentController@shipmentAutoBid');

Route::get('/profile/transporter/{id}', 'userfront\UserController@getTransporter');
Route::post('/enduser/submit/shipment', 'userfront\ShipmentController@submitShipment');
Route::post('/enduser/upload/image', 'userfront\ShipmentController@uploadImage');
Route::post('/enduser/listings/search', 'userfront\ShipmentController@search');
Route::resource('/enduser/listings', 'userfront\ShipmentController');
Route::get('/enduser/get/categories', 'userfront\ShipmentController@getCategories');
Route::get('/enduser/get/vehicles', 'userfront\ShipmentController@getVehicles');
Route::resource('/register', 'Auth\RegisterController');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/getshipment', 'userfront\ShipmentController@shipment');
Route::post('/logout', 'Auth\LoginController@logout');
Route::post('/forgot-pass', 'Auth\LoginController@forgetpass');
Route::post('/reset-pass', 'Auth\LoginController@resetpass');

Route::post('/payment/generate', 'frontdash\TransactionController@membershipTransaction');

Route::get('/loadlastshiptransaction', 'frontdash\TransactionController@loadlastshiptransaction');

Route::post('/paypal/confirm/payment', 'frontdash\TransactionController@confirmPayPalPayment');
Route::post('/multibanco/status','frontdash\TransactionController@checkMultibancoStatus');

Route::post('/enduser/get/help', 'frontdash\HomeController@sendEmail');


// AN
Route::get('/user/email/{email}', 'Auth\LoginController@existEmail');
Route::post('/form/shipment-create', 'userfront\ShipmentController@createShipment');
