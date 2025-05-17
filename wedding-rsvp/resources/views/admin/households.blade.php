@extends('layouts.app')

@section('content')
    <h1>Households</h1>

    @foreach($households as $household)
        <div style="margin-bottom: 2rem;">
            <h3>{{ $household->name }}</h3>
            <p>RSVP Link: <a href="{{ route('rsvp.capture', $household->token) }}" target="_blank">
                {{ route('rsvp.capture', $household->token) }}
            </a></p>

            <div>
                {!! QrCode::size(200)->generate(route('rsvp.capture', $household->token)) !!}
            </div>
        </div>
    @endforeach
@endsection
