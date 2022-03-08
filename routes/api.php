<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KostOwnerController;
use App\Http\Controllers\KostSeekerController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomController;

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

//Delete Image
Route::delete('/kost/{id}/destroy-image', [KostController::class, 'destroy_image'])->name('kost.destroy-image');
Route::delete('/kost/{id}/destroy-roomTypeImage', [RoomTypeController::class, 'destroyRoomTypeImage'])->name('kost.destroy-roomTypeImage');

