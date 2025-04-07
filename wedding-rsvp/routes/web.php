<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RSVPController;

use App\Models\Household;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rsvp/{token}', [RSVPController::class, 'show'])->name('rsvp.show');
Route::post('/rsvp/{token}', [RSVPController::class, 'submit'])->name('rsvp.submit');

Route::get('/admin/households', function () {
    $households = Household::all();
    return view('admin.households', compact('households'));
});
