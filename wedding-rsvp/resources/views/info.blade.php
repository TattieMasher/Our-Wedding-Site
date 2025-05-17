@extends('layouts.app')

@section('title', 'Alex & Candace - Fenwick Hotel')

@section('content')
<section class="wedding-info">
    <div class="info-grid">
        <div class="info-photo">
            <img src="{{ asset('images/eiffel-sm.jpg') }}" alt="Alex & Candace at Eiffel Tower">
        </div>
        <div class="info-text">
            <p>Our wedding will be held on <strong><u>Friday, 1st August, 2025 at 1:30pm</u></strong>.</p>
            <p>Please join us for our ceremony, a lovely meal, drinks, chats and dances!</p>
            <p><strong><em><u>No</u> dress code.</em></strong></p>
            <p>Just wear what makes you feel best!</p>
        </div>
    </div>

    <div class="venue-box">
        <h3>ARRIVAL BY 1:00PM</h3>
        <p>Fenwick Hotel</p>
        <p>Fenwick</p>
        <p>KA3 6AU</p>
    </div>

    <div class="schedule-grid">
        <div>
            <h4>Ceremony</h4>
            <p>1:30PM – 3:00PM</p>
        </div>
        <div>
            <h4>Photos</h4>
            <p>3:00PM – 3:45PM</p>
        </div>
        <div>
            <h4>Meal / Reception</h4>
            <p>4:00PM – Late!</p>
        </div>
    </div>

    <div class="gift-info">
        <div class="house">🏠</div>
        <p>
            Please RSVP and let us know you're coming!

            Your presence is the best gift we could ask for!
            <br><br>We've got all the “stuff” we need, but if you'd like to contribute to our new home fund, we'd be so grateful (no pressure, of course!). 💕
        </p>
        <a href="rsvp">Gift here</a>
    </div>
</section>
@endsection
