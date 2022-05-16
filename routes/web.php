<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KostOwnerController;
use App\Http\Controllers\KostSeekerController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\CommerceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RentDetailController;

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

Route::get('/admin', function () {
    return view('auth.login');
});


Route::get('home', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::post('/dropzone-store', 'App\Http\Controllers\DropzoneController@kostStore')->name('dropzone.store');

//Landing Page
Route::get('/', [LandingPageController::class, 'home'])->name('landingPage.home');
Route::get('/info', [LandingPageController::class, 'info'])->name('landingPage.info');
Route::get('/info/{id}', [LandingPageController::class, 'show'])->name('landingPage.show');

//Nama route : admin.user.{{nama_function_controller}} ex: admin.user.index
Route::prefix('admin')->middleware(['auth', 'auth.isAdmin'])->name('admin.')->group(function () {
    Route::resource('/admin', AdminController::class);
    Route::resource('/kost-owner', KostOwnerController::class);
    Route::resource('/kost-seeker', KostSeekerController::class);

    //Kost
    Route::get('/kost/{id}/show-index', [KostController::class, 'showIndex'])->name('kost.show-index');
    Route::get('/kost/admin-index', [KostController::class, 'adminIndex'])->name('kost.admin-index');
    Route::patch('/kost/{id}/confirm', [KostController::class, 'confirm'])->name('kost.confirm');
    Route::patch('/kost/{id}/reject', [KostController::class, 'reject'])->name('kost.reject');
});

Route::prefix('owner')->middleware(['auth', 'auth.isOwner'])->name('owner.')->group(function () {
    //Kost
    Route::resource('/kost', KostController::class);
    Route::post('/kost/{id}/request', [KostController::class, 'request'])->name('kost.request');

    //Room Type
    Route::get('/kost/{id}/room_type-create', [RoomTypeController::class, 'roomTypeCreate'])->name('kost.room_type.create');
    Route::post('/kost/{id}/room_type-store', [RoomTypeController::class, 'roomTypeStore'])->name('kost.room_type.store');
    Route::get('/kost/{id}/room_type-edit', [RoomTypeController::class, 'roomTypeEdit'])->name('kost.room_type.edit');
    Route::patch('/kost/{id}/room_type-update', [RoomTypeController::class, 'roomTypeUpdate'])->name('kost.room_type.update');
    
    //Room
    Route::resource('/room', RoomController::class);
    Route::post('/kost/{id}/room-store', [RoomController::class, 'roomStore'])->name('kost.room.store');
    Route::patch('/kost/{id}/room-update', [RoomController::class, 'roomUpdate'])->name('kost.room.update');

    //Rent
    Route::resource('/rent', RentController::class);
    Route::post('/rent/{id}/detail-store', [RentController::class, 'detailStore'])->name('rent.detailStore');
    Route::post('/rent/{id}/stop-rent', [RentController::class, 'stopRent'])->name('rent.stopRent');

    //Tenant
    Route::resource('/tenant', TenantController::class);

    //Booking
    Route::resource('/booking', BookingController::class);
    Route::post('/booking/{id}/accept', [BookingController::class, 'accept'])->name('booking.accept');
    Route::patch('/booking/{id}/reject', [BookingController::class, 'reject'])->name('booking.reject');

    //Rent Detail
    Route::post('/rentDetail', [RentDetailController::class, 'index'])->name('rentDetail.index');
    Route::post('/rentDetail/{id}/accept', [RentDetailController::class, 'accept'])->name('rentDetail.accept');
    Route::post('/rentDetail/{id}/reject', [RentDetailController::class, 'reject'])->name('rentDetail.reject');
});

Route::prefix('customer')->middleware(['auth', 'auth.isCustomer'])->name('customer.')->group(function () {
    //Commerce
    Route::resource('/commerce', CommerceController::class);

    //Booking
    Route::get('/booking/customer', [BookingController::class, 'indexCustomer'])->name('booking.indexCustomer');
    Route::post('/booking/customer/payment', [BookingController::class, 'payment'])->name('booking.payment');

    Route::resource('/history', HistoryController::class);
    Route::post('/history/{id}/detail-store', [HistoryController::class, 'detailStore'])->name('history.detailStore');
    Route::post('/history/{id}/stop-rent', [HistoryController::class, 'stopRent'])->name('history.stopRent');
    
    //Rent
    Route::resource('/rent', RentController::class);
    Route::post('/rent/{id}/detail-store', [RentController::class, 'detailStore'])->name('rent.detailStore');
    Route::post('/rent/{id}/stop-rent', [RentController::class, 'stopRent'])->name('rent.stopRent');

});