<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KostOwnerController;
use App\Http\Controllers\KostSeekerController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;

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

Route::get('/', function () {
    return view('layouts.landing');
});

Route::get('/admin', function () {
    return view('auth.login');
});


Route::get('home', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::post('/dropzone-store', 'App\Http\Controllers\DropzoneController@kostStore')->name('dropzone.store');

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
});