<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RSVPController;
use App\Models\Household;

Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/info', fn () => view('info'))->name('info');

// Redirect /rsvp with no token → homepage
Route::get('/rsvp', fn () => redirect()->route('home'));

// RSVP routes
Route::get('/rsvp/{token}', [RSVPController::class, 'show'])->name('rsvp.show');
Route::post('/rsvp/{token}', [RSVPController::class, 'submit'])->name('rsvp.submit');

// Temporary dev/admin route for QR code viewing
Route::get('/admin/households', function () {
    $households = Household::all();
    return view('admin.households', compact('households'));
});
