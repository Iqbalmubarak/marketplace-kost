<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KostOwnerController;
use App\Http\Controllers\KostSeekerController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\api\SelectController;
use App\Http\Controllers\api\PaymentController;
use App\Http\Controllers\api\MessageController;
use App\Http\Controllers\api\ChartController;
use App\Http\Controllers\api\MapController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\HistoryController;

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

//Public Routes
Route::get('/kost/get-location',[KostController::class, 'getLocation']);
Route::get('/kost',[KostController::class, 'getData']);
Route::get('/kost/room',[KostController::class, 'getDataRoom']);
Route::get('/kost/room-type',[RoomTypeController::class, 'getDataRoomType']);
Route::get('/admin',[AdminController::class, 'getData']);
Route::get('/kost-owner',[KostOwnerController::class, 'getData']);
Route::get('/kost-seeker',[KostSeekerController::class, 'getData']);
Route::get('/booking',[BookingController::class, 'getData']);
Route::get('/rent',[RentController::class, 'getData']);
Route::get('/history',[HistoryController::class, 'getData']);

//Select
Route::get('/select/room-type/{id}',[SelectController::class, 'roomType']);
Route::get('/select/room/{id}',[SelectController::class, 'room']);
Route::get('/select/tenant/{id}',[SelectController::class, 'tenant']);
Route::get('/select/duration/{id}',[SelectController::class, 'duration']);
Route::get('/select/duration_price/{id}',[SelectController::class, 'duration_price']);
Route::get('/select/optional/{id}',[SelectController::class, 'optional']);
Route::get('/select/rentRange/{id}',[SelectController::class, 'rentRange']);

//Select
Route::get('/payment/rent-payment/{id}',[PaymentController::class, 'rentPayment'])->name('payment.rent-payment');
Route::get('/payment/booking-payment/{id}',[PaymentController::class, 'bookingPayment'])->name('payment.booking-payment');
Route::post('/payment/add-paymentMethod',[PaymentController::class, 'addPaymentMethod'])->name('payment.addPaymentMethod');
Route::post('/payment/get-paymentMethod',[PaymentController::class, 'getPaymentMethod'])->name('payment.getPaymentMethod');

//Delete Image
Route::delete('/kost/{id}/destroy-image', [KostController::class, 'destroy_image'])->name('kost.destroy-image');
Route::delete('/kost/{id}/destroy-roomTypeImage', [RoomTypeController::class, 'destroyRoomTypeImage'])->name('kost.destroy-roomTypeImage');

//Message
Route::get('/message/send_message',[MessageController::class, 'sendMessage'])->name('message.sendMessage');
Route::get('/message/notification',[MessageController::class, 'notification'])->name('message.notification');

//Chart
Route::get('/chart/chart_income',[ChartController::class, 'chartIncome'])->name('chart.chartIncome');

//Map
Route::post('/map/get-kost', [MapController::class, 'getKost'])->name('map.getKost');
Route::get('/map/get-around', [MapController::class, 'getAround'])->name('map.getAround');

