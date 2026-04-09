@extends('layouts.app')

@section('title', 'All Guests')

@section('content')
<section class="admin-table">
    <h2>Guest Summary</h2>
    <table class="summary-table">
        <thead>
            <tr>
                <th>Total</th>
                <th>✅ Attending</th>
                <th>❌ Not Attending</th>
                <th>🤷 Unknown</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $guests->count() }}</td>
                <td>{{ $attending }}</td>
                <td>{{ $notAttending }}</td>
                <td>{{ $unknown }}</td>
            </tr>
        </tbody>
    </table>

    <h2>Guest List</h2>
    <table>
        <thead>
            <tr>
                <th>Household</th>
                <th>Name</th>
                <th>RSVP</th>
                <th>Diet</th>
                <th>Requirements</th>
                <th>Requests</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $guest)
                <tr>
                    <td>{{ $guest->household->name ?? '—' }}</td>
                    <td>{{ $guest->name }}</td>
                    <td>
                        @if(is_null($guest->is_attending))
                            <span style="color: gray;">—</span>
                        @elseif($guest->is_attending)
                            ✅ Attending
                        @else
                            ❌ Not Attending
                        @endif
                    </td>
                    <td>{{ ucfirst($guest->diet ?? '—') }}</td>
                    <td>{{ $guest->dietary_requirements ?? '—' }}</td>
                    <td>{{ $guest->special_requests ?? '—' }}</td>
                    <td>{{ $guest->updated_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
