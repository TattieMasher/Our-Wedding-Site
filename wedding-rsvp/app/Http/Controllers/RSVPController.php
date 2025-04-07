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

    public function submit(Request $request, $token)
    {
        $household = Household::with('guests')->where('token', $token)->first();

        if (!$household) {
            return redirect()->route('home');
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

        return redirect()->route('rsvp.show', $token)->with('success', 'Thanks for RSVPing!');
    }
}
