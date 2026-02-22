<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::view('/merci', 'merci')->name('merci');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Route de test pour les mails
    Route::get('/test-mail', function() {
        \Illuminate\Support\Facades\Mail::to(auth()->user()->email)->send(new \App\Mail\WelcomeBoutiqueMail(auth()->user()));
        return "Mail de test envoyé à " . auth()->user()->email;
    });
});

require __DIR__.'/auth.php';
