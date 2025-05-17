<div class="rsvp-form-section">
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form wire:submit.prevent="submit">
        @foreach($guests as $index => $guest)
            <div class="guest-section">
                <h3>
                    Guest {{ $index + 1 }}
                    @if(count($guests) > 1)
                        <button type="button" wire:click="removeGuest({{ $index }})">Remove</button>
                    @endif
                </h3>

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

                <label>Special Requests:
                    <textarea wire:model="guests.{{ $index }}.special_requests" rows="2"></textarea>
                </label>

                <label>Dietary Requirements/Allergies:</label>
                @foreach(['none', 'vegetarian', 'vegan', 'other'] as $diet)
                    <label>
                        <input type="radio" wire:model="guests.{{ $index }}.diet" value="{{ $diet }}">
                        {{ ucfirst($diet) }}
                    </label>
                @endforeach

                @if($guest['diet'] === 'other')
                    <textarea wire:model="guests.{{ $index }}.dietary_requirements" rows="2"
                        placeholder="Please describe dietary needs (e.g. allergies)"></textarea>
                @endif
            </div>
        @endforeach

        <div class="contact-section">
            <h3>Contact Details</h3>
            <label>Email Address (optional):
                <input type="email" wire:model="contact_email" placeholder="your@email.com">
            </label>

            <label>Phone Number (optional):
                <input type="tel" wire:model="contact_phone" placeholder="your phone number">
            </label>
        </div>

        <div style="text-align: center; margin-top: 1rem;">
            <button type="button" wire:click="addGuest" class="add-guest-btn">+ Add Another Guest</button>
        </div>

        <button type="submit" class="submit-btn">Submit RSVP</button>
    </form>
</div>
