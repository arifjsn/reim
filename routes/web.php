<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReimbursementController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Home
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Reimbursement routes
Route::middleware('auth')->group(function () {
    Route::get('/reimbursement', [ReimbursementController::class, 'index'])->name('reimbursement.index');
    Route::get('/reimbursement/{id}', [ReimbursementController::class, 'claimFormFilled'])->name('reimbursement.detail');
});

// Claim routes (only for PEGAWAI)
Route::middleware(['auth', 'department:PEGAWAI'])->group(function () {
    Route::get('/claim', [ReimbursementController::class, 'claimForm'])->name('claim.form');
    Route::post('/claim', [ReimbursementController::class, 'claim'])->name('claim.submit');
    Route::post('/cancelClaim', [ReimbursementController::class, 'cancelClaim'])->name('claim.cancel');
});

// Update status (HR & FINANCE)
Route::post('/updateStatus', [ReimbursementController::class, 'updateStatus'])
    ->name('reimbursement.updateStatus')
    ->middleware(['auth', 'department:HR,FINANCE']);
