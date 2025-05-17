@extends('layouts.app')

@section('title', 'RSVP - Alex & Candace')

@section('content')
    <section class="rsvp-form-section">
        <h2>RSVP for {{ $household->name }}</h2>

        @include('rsvp.form-fields', ['household' => $household])
    </section>
@endsection
