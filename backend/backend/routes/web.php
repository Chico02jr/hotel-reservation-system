<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;

// Page accueil
Route::get('/', function () {
    return view('home');
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Chambres (public)
Route::get('/chambres', [ChambreController::class, 'index'])->name('chambres.index');
Route::get('/chambres/{chambre}', [ChambreController::class, 'show'])->name('chambres.show');

// Réservations (connecté)
// Réservations (sans auth temporairement)
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/create/{chambre}', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::put('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');

// Admin
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/chambres', [AdminController::class, 'chambres'])->name('admin.chambres');
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('admin.reservations');
    Route::put('/reservations/{reservation}/confirmer', [AdminController::class, 'confirmerReservation'])->name('admin.reservations.confirmer');
    Route::put('/reservations/{reservation}/annuler', [AdminController::class, 'annulerReservation'])->name('admin.reservations.annuler');
    Route::post('/chambres', [ChambreController::class, 'store'])->name('admin.chambres.store');
    Route::put('/chambres/{chambre}', [ChambreController::class, 'update'])->name('admin.chambres.update');
    Route::delete('/chambres/{chambre}', [ChambreController::class, 'destroy'])->name('admin.chambres.destroy');
});