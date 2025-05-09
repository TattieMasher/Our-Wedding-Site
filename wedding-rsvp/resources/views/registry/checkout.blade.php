@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="checkout-wrapper">
    <h2>Your Gift Selections</h2>

    <ul class="checkout-list">
        @foreach($cart as $item)
            <li>
                <strong>{{ $item['quantity'] }}x {{ $item['title'] }}</strong>
                – £{{ $item['price'] * $item['quantity'] }}
            </li>
        @endforeach
    </ul>

    <h3>Total: £{{ $total }}</h3>

    <form method="POST" action="{{ route('registry.submit') }}" class="contribution-form">
        @csrf

        <input type="hidden" name="amount" value="{{ $total }}">
        <input type="hidden" name="items" value="{{ json_encode($cart) }}">

        <div class="form-group">
            <input type="text" name="name" placeholder="Your name (optional)">
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="Your email (optional)">
        </div>

        <div class="form-group">
            <textarea name="message" rows="4" placeholder="Gift message (optional)"></textarea>
        </div>

        <button type="submit" class="checkout-button">Send & Gift via PayPal</button>
    </form>

    <code class="checkout-note">
        {{ collect($cart)->map(fn($item) => "{$item['title']} (£" . ($item['price'] * $item['quantity']) . ")")->join(', ') }}
    </code>
</div>
@endsection
