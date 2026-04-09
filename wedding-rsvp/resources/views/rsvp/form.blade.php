@extends('layouts.app')

@section('title', 'RSVP - Alex & Candace')

@section('content')
    <section class="rsvp-form-section">
        <h2>RSVP</h2>

        <livewire:rsvp.guest-form :household="$household" />
    </section>
@endsection
