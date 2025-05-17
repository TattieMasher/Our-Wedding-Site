<?php

namespace App\Livewire\Rsvp;

use App\Models\Guest;
use App\Models\Household;
use Livewire\Component;

class GuestForm extends Component
{
    public array $guests = [];
    public string $contact_email = '';
    public string $contact_phone = '';
    public ?Household $household = null;

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

        if (!$this->guests) {
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
        $this->validate([
            'guests.*.name' => 'required|string|max:255',
            'guests.*.is_attending' => 'required|boolean',
            'guests.*.diet' => 'required|string',
            'guests.*.dietary_requirements' => 'nullable|string|max:500',
            'guests.*.special_requests' => 'nullable|string|max:500',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
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
        } else {
            // Anonymous submission – store locally or send by email/log/etc.
            // You could also optionally save this to a separate table
            logger('Anonymous RSVP', [
                'guests' => $this->guests,
                'contact_email' => $this->contact_email,
                'contact_phone' => $this->contact_phone,
            ]);
        }

        session()->flash('success', 'RSVP submitted successfully!');
        $this->reset(['guests', 'contact_email', 'contact_phone']);
        $this->guests[] = $this->blankGuest();
    }

    public function render()
    {
        return view('livewire.rsvp.guest-form');
    }
}
