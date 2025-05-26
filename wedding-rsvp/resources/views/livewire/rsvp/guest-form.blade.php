<div class="rsvp-form-section">
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form wire:submit.prevent="submit">
        @foreach($guests as $index => $guest)
            <div class="guest-section" wire:key="guest-{{ $index }}" x-data="{ showDietNote: @js($guest['diet'] === 'other') }" x-effect="showDietNote = $wire.guests[{{ $index }}].diet === 'other'">
                <h3>
                    @if(count($guests) > 1)
                        <button type="button" class="remove-guest-button" wire:click="removeGuest({{ $index }})">Remove</button>
                    @endif
                </h3>

                <div class="form-group">
                    <label>Name:
                        <input type="text" wire:model="guests.{{ $index }}.name" required>
                    </label>
                    <label>
                        <input type="radio" wire:model="guests.{{ $index }}.is_attending" value="1">
                        Attending
                    </label>
                    <label>
                        <input type="radio" wire:model="guests.{{ $index }}.is_attending" value="0">
                        Not Attending
                    </label>
                </div>

                <div class="form-group">
                    <label>Dietary Requirements / Allergies:</label>
                    @foreach(['none', 'vegetarian', 'vegan', 'other'] as $diet)
                        <label>
                            <input type="radio"
                                wire:model="guests.{{ $index }}.diet"
                                value="{{ $diet }}"
                                name="guest-{{ $index }}-diet">
                                {{ ucfirst($diet) }}
                        </label>
                    @endforeach
                    <div x-show="showDietNote" x-transition>
                        <textarea
                            wire:model="guests.{{ $index }}.dietary_requirements"
                            rows="2"
                            placeholder="Please describe dietary needs (e.g. allergies)"
                        ></textarea>
                    </div>
                </div>

                <label>Special Requests (optional):
                    <textarea wire:model="guests.{{ $index }}.special_requests" rows="2"></textarea>
                </label>
            </div>
        @endforeach

        <div class="guest-section">
            <div style="text-align: center; margin-top: 1rem;">
                <button type="button" wire:click="addGuest" class="add-guest-btn">+ Add Another Guest</button>
            </div>
        </div>

        <div class="song-request-section">
            <h3>Song Requests (optional)</h3>
            <p>Got any tunes you want to hear at the party?</p>

            @foreach ($song_requests as $i => $song)
                <div class="song-request" wire:key="song-{{ $i }}">
                    <input type="text" placeholder="Song Title" wire:model="song_requests.{{ $i }}.title">
                    <input type="text" placeholder="Artist" wire:model="song_requests.{{ $i }}.artist">
                    <button type="button" wire:click="removeSongRequest({{ $i }})">Remove</button>
                </div>
            @endforeach

            <button type="button" wire:click="addSongRequest">+ Add Song(s)</button>
        </div>

        <div class="contact-section">
            <h3>Contact Details</h3>
            <p>In case of any updates</p>
            <label>Email Address (optional):
                <input type="email" wire:model="contact_email" placeholder="your@email.com">
            </label>

            <label>Phone Number (optional):
                <input type="tel" wire:model="contact_phone" placeholder="your phone number">
            </label>
        </div>

        <button type="submit" class="submit-btn">Submit RSVP</button>
    </form>
</div>
