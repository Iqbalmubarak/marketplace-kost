<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KostOwnerController;
use App\Http\Controllers\KostSeekerController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\RoomController;

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
});

Route::prefix('owner')->middleware(['auth', 'auth.isOwner'])->name('owner.')->group(function () {
    Route::resource('/kost', KostController::class);
    Route::resource('/room', RoomController::class);
});