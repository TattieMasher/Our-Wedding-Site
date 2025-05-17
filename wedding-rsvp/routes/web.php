<?php

use App\Http\Controllers\RegistryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RSVPController;
use App\Models\Household;

Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/info', fn () => view('info'))->name('info');

// Redirect /rsvp with no token → homepage
Route::get('/rsvp', fn () => redirect()->route('home'));

// Token entry (from QR code) – stores token in session and redirects to welcome
Route::get('/{token}', [RSVPController::class, 'captureToken'])->name('rsvp.capture');

// New RSVP form page (uses session token)
Route::get('/rsvp', [RSVPController::class, 'form'])->name('rsvp.form');
Route::post('/rsvp', [RSVPController::class, 'submit'])->name('rsvp.submit');

// Forget session (reset household)
Route::get('/forget', [RSVPController::class, 'forget'])->name('rsvp.forget');

// Temporary dev/admin route for QR code viewing
Route::get('/admin/households', function () {
    $households = Household::all();
    return view('admin.households', compact('households'));
});


// Registry stuff
Route::get('/gifts', [RegistryController::class, 'index'])->name('registry.index');
Route::post('/cart/add', [RegistryController::class, 'addToCart'])->name('cart.add');
Route::get('/checkout', [RegistryController::class, 'checkout'])->name('registry.checkout');
Route::post('/checkout/submit', [RegistryController::class, 'submitContribution'])->name('registry.submit');
Route::get('/checkout/clear', [RegistryController::class, 'clearCart'])->name('registry.clear');
