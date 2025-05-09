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

    <a href="https://paypal.me/McCaughranWedding/{{ $total }}" class="checkout-button" target="_blank">Send via PayPal</a>

    <code>
        {{ collect($cart)->map(fn($item) => "{$item['title']} (£" . ($item['price'] * $item['quantity']) . ")")->join(', ') }}
    </code>
</div>
@endsection
