@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('rsvp.submit', $household->token) }}">
    @csrf

    @foreach ($household->guests as $guest)
    <div class="guest-section">
        <h3>{{ $guest->name }}</h3>

        <label>
            <input type="radio" name="guest[{{ $guest->id }}][is_attending]" value="1"
                {{ $guest->is_attending === true ? 'checked' : '' }}> Attending
        </label>
        <label>
            <input type="radio" name="guest[{{ $guest->id }}][is_attending]" value="0"
                {{ $guest->is_attending === false ? 'checked' : '' }}> Not Attending
        </label>

        <label>Special Requests:</label>
        <textarea name="guest[{{ $guest->id }}][special_requests]">{{ $guest->special_requests }}</textarea>

        <label>Dietary Requirements/Allergies:</label>
        <label>
            <input type="radio" name="guest[{{ $guest->id }}][diet]" value="1"
                {{ $guest->is_attending === true ? 'checked' : '' }}> None
        </label>
        <label>
            <input type="radio" name="guest[{{ $guest->id }}][diet]" value="0"
                {{ $guest->is_attending === false ? 'checked' : '' }}> Vegetarian
        </label>
        <label>
            <input type="radio" name="guest[{{ $guest->id }}][diet]" value="0"
                {{ $guest->is_attending === false ? 'checked' : '' }}> Vegan
        </label>
        <label>
            <input type="radio" name="guest[{{ $guest->id }}][diet]" value="0"
                {{ $guest->is_attending === false ? 'checked' : '' }}> Other
        </label>
        <textarea name="guest[{{ $guest->id }}][dietary_requirements]">{{ $guest->dietary_requirements }}</textarea>
    </div>

    <div class="contact-section">
        <h3>Contact Details</h3>
        <label>Email Address (optional):</label>
        <input type="email" name="contact_email" placeholder="your@email.com" required>
        <label>Phone Number (optional):</label>
        <input type="number" name="contact_email" placeholder="your phone number" required>
    </div>

@endforeach

    <button type="submit">Submit RSVP</button>
</form>
