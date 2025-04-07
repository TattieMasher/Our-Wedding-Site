@extends('layouts.app')

@section('title', 'Alex & Candace')

@section('content')
    <section class="hero">
        <h1 class="hero-hearts">❤❤</h1>
        <div class="hero-name-detail-wrapper">
            <h1 class="hero-names">
                Alex M<sup>c</sup>Caughran<br> — and — <br>Candace Scoular
            </h1>
            <div class="hero-details" id="info">
                FRIDAY 1ˢᵗ AUGUST 2025<br>
                <a href="#">FENWICK HOTEL</a><br>
                Arrival by 1:30pm
            </div>
        </div>
    </section>

    <section class="rsvp-invite" id="rsvp">
        <p>We request the pleasure of your company as we celebrate our love.</p>
        <a class="rsvp-button" href="#rsvp-form">Please let us know if you can attend (RSVP)</a>
    </section>

    @isset($household)
        <section class="rsvp-form-section" id="rsvp-form">
            <h2>RSVP for {{ $household->name }}</h2>
            @include('rsvp.form-fields', ['household' => $household])
        </section>
    @endisset
@endsection
