<?php

namespace App\Livewire\Rsvp;

use App\Models\Guest;
use App\Models\Household;
use App\Models\RsvpSubmission;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class GuestForm extends Component
{
    public array $guests = [];

    public string $contact_email = '';

    public string $contact_phone = '';

    public ?Household $household = null;

    public array $song_requests = [];

    public function mount(): void
    {
        $token = session('rsvp_token');

        if ($token) {
            $this->household = Household::with('guests')->where('token', $token)->first();

            if ($this->household) {
                $this->guests = $this->household->guests->map(function ($guest) {
                    return [
                        'id' => $guest->id,
                        'name' => $guest->name,
                        'is_attending' => $guest->is_attending,
                        'diet' => $guest->diet ?? 'none',
                        'dietary_requirements' => $guest->dietary_requirements,
                        'special_requests' => $guest->special_requests,
                    ];
                })->toArray();
            }
        }

        if (! $this->guests) {
            $this->guests[] = $this->blankGuest();
        }
    }

    public function addGuest(): void
    {
        $this->guests[] = $this->blankGuest();
    }

    public function removeGuest(int $index): void
    {
        unset($this->guests[$index]);
        $this->guests = array_values($this->guests);
    }

    public function blankGuest(): array
    {
        return [
            'id' => null,
            'name' => '',
            'is_attending' => null,
            'diet' => 'none',
            'dietary_requirements' => '',
            'special_requests' => '',
        ];
    }

    public function submit(): void
    {
        $limiterKey = 'rsvp-livewire:'.request()->ip();

        if (RateLimiter::tooManyAttempts($limiterKey, 10)) {
            $this->addError('_form', 'Too many RSVP attempts. Please try again in a minute.');

            return;
        }

        RateLimiter::hit($limiterKey, 60);

        $this->validate([
            'guests.*.name' => 'required|string|max:255',
            'guests.*.is_attending' => 'required|boolean',
            'guests.*.diet' => 'required|string',
            'guests.*.dietary_requirements' => 'nullable|string|max:500',
            'guests.*.special_requests' => 'nullable|string|max:500',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'song_requests.*.title' => 'nullable|string|max:255',
            'song_requests.*.artist' => 'nullable|string|max:255',
        ]);

        if ($this->household) {
            foreach ($this->guests as $guestData) {
                $guest = Guest::find($guestData['id']);
                if ($guest) {
                    $guest->update([
                        'is_attending' => $guestData['is_attending'],
                        'diet' => $guestData['diet'],
                        'dietary_requirements' => $guestData['dietary_requirements'],
                        'special_requests' => $guestData['special_requests'],
                    ]);
                }
            }
        }

        if ($this->household) {
            foreach ($this->song_requests as $song) {
                if (! empty($song['title'])) {
                    $this->household->songRequests()->create([
                        'title' => $song['title'],
                        'artist' => $song['artist'] ?? null,
                    ]);
                }
            }
        }

        RsvpSubmission::create([
            'household_id' => $this->household?->id,
            'contact_email' => $this->contact_email,
            'contact_phone' => $this->contact_phone,
            'payload' => [
                'guests' => $this->guests,
                'songs' => $this->song_requests,
            ],
        ]);

        redirect()->route('rsvp.thanks');
    }

    public function addSongRequest(): void
    {
        $this->song_requests[] = ['title' => '', 'artist' => ''];
    }

    public function removeSongRequest(int $index): void
    {
        unset($this->song_requests[$index]);
        $this->song_requests = array_values($this->song_requests);
    }

    public function render()
    {
        return view('livewire.rsvp.guest-form');
    }
}
