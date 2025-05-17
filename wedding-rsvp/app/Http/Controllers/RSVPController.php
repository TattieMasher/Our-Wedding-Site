<?php

namespace App\Http\Controllers;

use App\Models\Household;
use Illuminate\Http\Request;

class RSVPController extends Controller
{
    public function show($token)
    {
        $household = Household::with('guests')->where('token', $token)->first();

        if (!$household) {
            return redirect()->route('home');
        }

        return view('welcome', compact('household'));
    }

    public function submit(Request $request)
    {
        $token = session('rsvp_token');

        if (!$token) {
            return redirect()->route('home')->with('error', 'No RSVP token found in session.');
        }

        $household = Household::with('guests')->where('token', $token)->first();

        if (!$household) {
            return redirect()->route('home')->with('error', 'Invalid or expired RSVP link.');
        }

        foreach ($household->guests as $guest) {
            $guest->update([
                'is_attending' => $request->input("guest.{$guest->id}.is_attending") === '1',
                'special_requests' => $request->input("guest.{$guest->id}.special_requests"),
            ]);
        }

        foreach ($request->input('song_requests', []) as $song) {
            if (!empty($song['title'])) {
                $household->songRequests()->create([
                    'title' => $song['title'],
                    'artist' => $song['artist'] ?? null,
                ]);
            }
        }

        return redirect()->route('rsvp.form')->with('success', 'Thanks for RSVPing!');
    }

    public function captureToken($token)
    {
        $household = Household::with('guests')->where('token', $token)->first();

        if (!$household) {
            return redirect()->route('home');
        }

        session(['rsvp_token' => $token]);
        return redirect()->route('home'); // You can also redirect to `info` or somewhere else if preferred
    }

    public function form()
    {
        $token = session('rsvp_token');

        if (!$token) {
            dd('TODO: Non-authed form');
        }

        $household = Household::with('guests')->where('token', $token)->first();

        if (!$household) {
            return redirect()->route('home')->with('error', 'Invalid or expired RSVP link.');
        }

        return view('rsvp.form', [
            'household' => $household ?? null,
        ]);
    }

    public function forget()
    {
        session()->flush();
        return redirect()->route('home')->with('success', 'RSVP session has been cleared.');
    }
}
