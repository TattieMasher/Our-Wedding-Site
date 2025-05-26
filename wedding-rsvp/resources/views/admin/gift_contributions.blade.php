@extends('layouts.app')

@section('title', 'Gift Contributions')

@section('content')
<section class="admin-contributions">
    <h1>🎁 Gift Contributions</h1>

    @if($contributions->isEmpty())
        <p>No contributions have been made yet.</p>
    @else
        <div class="contributions-list">
            @foreach($contributions as $contribution)
                <div class="contribution-card">
                    <div class="header">
                        <strong>{{ $contribution->name ?? 'Anonymous' }}</strong>
                        <span>£{{ number_format($contribution->amount) }}</span>
                    </div>

                    @if($contribution->email)
                        <p><strong>Email:</strong> {{ $contribution->email }}</p>
                    @endif

                    @if($contribution->message)
                        <p><strong>Message:</strong><br>{{ $contribution->message }}</p>
                    @endif

                    @if(!empty($contribution->items))
                        <div class="item-list">
                            <strong>Items:</strong>
                            <ul>
                                @foreach($contribution->items as $item)
                                    <li>
                                        {{ $item['title'] }}
                                        (x{{ $item['quantity'] ?? 1 }} – £{{ $item['price'] * ($item['quantity'] ?? 1) }})
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <p class="timestamp">
                        Submitted on {{ $contribution->created_at->format('jS F Y, H:i') }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
