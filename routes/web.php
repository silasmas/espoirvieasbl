<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');
Route::get('/evenements', [HomeController::class, 'events'])->name('events');
Route::get('/evenements/{activity}', [HomeController::class, 'showEvent'])->name('events.show');
Route::get('/faire-un-don', [HomeController::class, 'donate'])->name('donate');
Route::get('/nous-contacter', [HomeController::class, 'contact'])->name('contact');
Route::post('/nous-contacter', [HomeController::class, 'storeContactMessage'])->name('contact.store');
Route::post('/newsletter/subscribe', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [HomeController::class, 'unsubscribeNewsletter'])->name('newsletter.unsubscribe');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
