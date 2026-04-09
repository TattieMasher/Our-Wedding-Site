<?php

use App\Http\Controllers\RegistryController;
use App\Http\Controllers\RSVPController;
use App\Models\Household;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/info', fn () => view('info'))->name('info');

// Forget session (reset household)
Route::get('/forget', [RSVPController::class, 'forget'])->name('rsvp.forget');

// Admin dashboard for RSVP + Registry viewing
Route::prefix('admin')->group(function () {
    // Temporary dev/admin route for QR code viewing
    Route::get('/households', fn () => view('admin.households', [
        'households' => \App\Models\Household::with('guests')->get(),
    ]))->name('admin.households');

    // Temporary dev/admin route for guest statuses
    Route::get('/guests', function () {
        $guests = \App\Models\Guest::with('household')
            ->join('households', 'guests.household_id', '=', 'households.id')
            ->orderBy('households.name')
            ->orderBy('guests.name')
            ->select('guests.*') // important to avoid columns clashing
            ->get();

        $attending = $guests->where('is_attending', true)->count();
        $notAttending = $guests->where('is_attending', false)->count();
        $unknown = $guests->whereNull('is_attending')->count();

        return view('admin.guests', compact('guests', 'attending', 'notAttending', 'unknown'));
    })->name('admin.guests');

    // Temporary dev/admin route for submission viewing
    Route::get('/rsvp-submissions', fn () => view('admin.rsvp_submissions', [
        'submissions' => \App\Models\RsvpSubmission::latest()->get(),
    ]))->name('admin.rsvp_submissions');

    // Temporary dev/admin route for gift contributions
    Route::get('/gift-contributions', fn () => view('admin.gift_contributions', [
        'contributions' => \App\Models\GiftContribution::latest()->get(),
    ]))->name('admin.gift_contributions');
});

// Registry stuff
Route::get('/gifts', [RegistryController::class, 'index'])->name('registry.index');
Route::post('/cart/add', [RegistryController::class, 'addToCart'])->name('cart.add');
Route::get('/checkout', [RegistryController::class, 'checkout'])->name('registry.checkout');
Route::post('/checkout/submit', [RegistryController::class, 'submitContribution'])
    ->middleware('throttle:registry-submit')
    ->name('registry.submit');
Route::get('/checkout/clear', [RegistryController::class, 'clearCart'])->name('registry.clear');

// RSVP stuff
// Redirect /rsvp with no token → homepage
Route::get('/rsvp', fn () => redirect()->route('home'));

// Token entry (from QR code) – stores token in session and redirects to welcome
Route::get('/{token}', [RSVPController::class, 'captureToken'])->name('rsvp.capture');

// New RSVP form page (uses session token)
Route::get('/rsvp', [RSVPController::class, 'form'])->name('rsvp.form');
Route::post('/rsvp', [RSVPController::class, 'submit'])
    ->middleware('throttle:rsvp-submit')
    ->name('rsvp.submit');
Route::get('/rsvp/thanks', fn () => view('rsvp.thanks'))->name('rsvp.thanks');
