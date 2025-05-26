@extends('layouts.app')

@section('title', 'Thanks for RSVPing!')

@section('content')
    <section class="thanks-page">
        <div class="thanks-card">
            <h1>🎉 Thank You!</h1>
            <p>Your RSVP has been submitted.</p>
            <p>If you need to make changes later, just return to the RSVP page using your original invite link.</p>
            <a href="{{ route('rsvp.form') }}" class="back-link">Return to RSVP Form</a>
        </div>
    </section>
@endsection
