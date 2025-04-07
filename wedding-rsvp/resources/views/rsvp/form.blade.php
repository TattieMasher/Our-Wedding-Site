@extends('layouts.app')

@section('content')
    <h1>RSVP for {{ $household->name }}</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('rsvp.submit', $household->token) }}">
        @csrf

        @foreach ($household->guests as $guest)
            <div>
                <h3>{{ $guest->name }}</h3>
                <label>
                    <input type="radio" name="guest[{{ $guest->id }}][is_attending]" value="1"
                        {{ $guest->is_attending === true ? 'checked' : '' }}> Attending
                </label>
                <label>
                    <input type="radio" name="guest[{{ $guest->id }}][is_attending]" value="0"
                        {{ $guest->is_attending === false ? 'checked' : '' }}> Not Attending
                </label>
                <br>
                <label>
                    Special Requests:
                    <textarea name="guest[{{ $guest->id }}][special_requests]">{{ $guest->special_requests }}</textarea>
                </label>
            </div>
            <hr>
        @endforeach

        <h2>Song Requests</h2>
        @for ($i = 0; $i < 3; $i++)
            <div>
                <input type="text" name="song_requests[{{ $i }}][title]" placeholder="Song Title">
                <input type="text" name="song_requests[{{ $i }}][artist]" placeholder="Artist (optional)">
            </div
