<form method="POST" action="{{ route('rsvp.submit', $household->token) }}">
    @csrf

    @foreach ($household->guests as $guest)
        <div class="guest-section" data-guest-id="{{ $guest->id }}">
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
            <textarea name="guest[{{ $guest->id }}][special_requests]" rows="2">{{ $guest->special_requests }}</textarea>

            <label>Dietary Requirements/Allergies:</label>
            @php
                $dietOptions = ['none', 'vegetarian', 'vegan', 'other'];
                $selectedDiet = $guest->diet ?? 'none';
            @endphp
            @foreach ($dietOptions as $option)
                <label>
                    <input type="radio"
                        name="guest[{{ $guest->id }}][diet]"
                        value="{{ $option }}"
                        {{ $selectedDiet === $option ? 'checked' : '' }}
                        class="diet-radio"
                        data-guest="{{ $guest->id }}">
                    {{ ucfirst($option) }}
                </label>
            @endforeach

            <textarea
                name="guest[{{ $guest->id }}][dietary_requirements]"
                rows="2"
                class="diet-other-textarea"
                data-guest="{{ $guest->id }}"
                style="{{ $selectedDiet === 'other' ? '' : 'display:none;' }}"
                placeholder="Please describe dietary needs (e.g. allergies)"
            >{{ $guest->dietary_requirements }}</textarea>
        </div>
    @endforeach

    <div class="contact-section">
        <h3>Contact Details</h3>
        <label>Email Address (optional):</label>
        <input type="email" name="contact_email" placeholder="your@email.com">

        <label>Phone Number (optional):</label>
        <input type="tel" name="contact_phone" placeholder="your phone number">
    </div>

    <button type="submit" class="submit-btn">Submit RSVP</button>
</form>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.diet-radio').forEach(radio => {
            radio.addEventListener('change', function () {
                const guestId = this.dataset.guest;
                const isOther = this.value === 'other';

                const textarea = document.querySelector(`.diet-other-textarea[data-guest="${guestId}"]`);
                if (textarea) {
                    textarea.style.display = isOther ? 'block' : 'none';
                }
            });
        });
    });
</script>
@endpush
