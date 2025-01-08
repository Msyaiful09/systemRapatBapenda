<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/dashboard/konfirmasi/{id}', [BookingController::class, 'konfirmasiJadwal'])->name('konfirmasiBooking');
Route::post('/dashboard/tolak/{id}', [BookingController::class, 'tolakJadwal'])->name('tolakBooking');

Route::POST('/dashboard/update-ruangan', [RoomController::class, 'update'])->name('updateRoom');

Route::resource('rooms', RoomController::class);
Route::resource('bookings', BookingController::class);
Route::resource('admin', AdminController::class);

Route::POST('/loginUrl', [LoginController::class, 'login'])->name('loginUrl');
