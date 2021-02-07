<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AcademicSeasonController;
use App\Http\Controllers\TimetableController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::delete('/register/{user}', [RegisterController::class, 'destroy'])->name('register.user');
Route::post('register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard', [DashboardController::class, 'update'])->name('dashboard.active');

Route::get('/timetable/{id}', [TimetableController::class, 'show'])->name('timetable');
Route::post('/timetable', [TimetableController::class, 'store'])->name('timetable.generate');

Route::post('/new', [AcademicSeasonController::class, 'store'])->name('term.new');

Route::post('logout', [LogoutController::class, 'store'])->name('logout');
