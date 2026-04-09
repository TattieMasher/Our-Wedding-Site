@extends('layouts.app')

@section('title', 'RSVP Submissions')

@section('content')
<section class="admin-table">
    <h2>RSVP Submissions</h2>
    <table>
        <thead>
            <tr>
                <th>Household</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Guests</th>
                <th>Songs</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submissions as $submission)
                <tr>
                    <td>{{ optional($submission->household)->name ?? 'Anonymous' }}</td>
                    <td>{{ $submission->contact_email }}</td>
                    <td>{{ $submission->contact_phone }}</td>
                    <td>
                        <ul>
                            @foreach($submission->payload['guests'] ?? [] as $guest)
                                <li>{{ $guest['name'] }} — {{ $guest['is_attending'] ? '✅' : '❌' }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach($submission->payload['songs'] ?? [] as $song)
                                <li>{{ $song['title'] }} {{ $song['artist'] ? 'by ' . $song['artist'] : '' }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $submission->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
