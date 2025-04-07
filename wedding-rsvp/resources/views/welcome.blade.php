@extends('layouts.app')

@section('title', 'Alex & Candace')

@section('content')
    <section class="hero">
        <h1 class="hero-hearts">
            <span class="material-symbols-outlined">favorite</span>
            <span class="material-symbols-outlined">favorite</span>
        </h1>
        <h1 class="hero-names">
            Alex M<sup>c</sup>Caughran
            <br> — and — <br>
            Candace Scoular
        </h1>
        <div class="hero-details" id="info">
            FRIDAY 1ˢᵗ AUGUST 2025<br>
            <a href="#">FENWICK HOTEL</a><br>
            Arrival by 1:30pm
        </div>
    </section>

    <section class="rsvp-invite" id="rsvp">
        <p>We request the pleasure of your company as we celebrate our love.</p>
        <a class="rsvp-button" href="#qr">Please let us know if you can attend (RSVP)</a>
    </section>
@endsection
