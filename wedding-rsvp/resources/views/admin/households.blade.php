@extends('layouts.app')

@section('title', 'Admin – Households')

@section('content')
    <section class="admin-households">
        <h1>Households</h1>

        <div class="household-grid">
            @foreach($households as $household)
                <div class="household-card">
                    <h3>{{ $household->name }}</h3>

                    <p>
                        <strong>RSVP Link:</strong><br>
                        <a href="{{ route('rsvp.capture', $household->token) }}" target="_blank">
                            {{ route('rsvp.capture', $household->token) }}
                        </a>
                    </p>

                    @if($household->guests->isNotEmpty())
                        <div class="guest-list">
                            <strong>Guests:</strong>
                            <ul>
                                @foreach($household->guests as $guest)
                                    <li>
                                        {{ $guest->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="qr-code">
                        {!! QrCode::size(200)->generate(route('rsvp.capture', $household->token)) !!}
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
