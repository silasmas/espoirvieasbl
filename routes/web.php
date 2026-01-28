<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonorDashboardController;
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');
Route::get('/notre-equipe', [HomeController::class, 'team'])->name('team');
Route::get('/evenements', [HomeController::class, 'events'])->name('events');
Route::get('/evenements/{activity}', [HomeController::class, 'showEvent'])->name('events.show');
Route::get('/faire-un-don', [HomeController::class, 'donate'])->name('donate');
Route::get('/faire-un-don/{activity}', [HomeController::class, 'showDonationDetail'])->name('donate.detail');
Route::post('/faire-un-don', [HomeController::class, 'processDonation'])->name('donate.process');
Route::post('/faire-un-don-spontane', [HomeController::class, 'processSpontaneousDonation'])->name('donate.processSpontaneous');
Route::post('/devenir-donateur', [HomeController::class, 'registerDonor'])->name('donor.register');
Route::get('/nous-contacter', [HomeController::class, 'contact'])->name('contact');
Route::post('/nous-contacter', [HomeController::class, 'storeContactMessage'])->name('contact.store');
Route::post('/newsletter/subscribe', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [HomeController::class, 'unsubscribeNewsletter'])->name('newsletter.unsubscribe');

// Route de recherche globale (API)
Route::get('/api/search', [HomeController::class, 'globalSearch'])->name('api.search');

// Routes pour les articles/blog
Route::get('/articles', [HomeController::class, 'articles'])->name('articles');
Route::get('/articles/{slug}', [HomeController::class, 'showArticle'])->name('article.show');

// Pages légales
Route::view('/conditions-utilisation', 'pages.terms')->name('terms');
Route::view('/politique-confidentialite', 'pages.privacy')->name('privacy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Espace donateur
    Route::get('/mon-profil', [DonorDashboardController::class, 'profile'])->name('monProfil');
    Route::get('/mes-dons', [DonorDashboardController::class, 'donations'])->name('donor.donations');
    Route::get('/mes-activites', [DonorDashboardController::class, 'activities'])->name('donor.activities');
    Route::patch('/mon-profil/update', [DonorDashboardController::class, 'updateProfile'])->name('donor.profile.update');
    Route::post('/mes-dons/envoyer', [DonorDashboardController::class, 'sendDonation'])->name('donor.sendDonation');
});

require __DIR__.'/auth.php';
