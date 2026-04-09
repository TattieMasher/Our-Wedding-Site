@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="checkout-wrapper">
    <h2>Thanks so much for your generosity!</h2>
    <h4>We really appreciate it!</h4>

    @if (session('error'))
        <p class="checkout-error" role="alert">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('registry.submit') }}" class="contribution-form">
        @csrf

        <input type="hidden" name="amount" value="{{ $total }}">
        <input type="hidden" name="items" value="{{ json_encode($cart) }}">

        <div class="form-group">
            <input type="text" name="name" required placeholder="Your name">
        </div>

        <div class="form-group">
            <textarea name="message" rows="4" placeholder="Gift message (optional)"></textarea>
        </div>

        <button type="submit" class="checkout-button">Send & Gift via PayPal</button>
    </form>

    <div class="checkout-summary">
        <h4>Summary</h4>
        <ul>
            @foreach($cart as $item)
                <li><span>{{ $item['title'] }}</span> <span>£{{ $item['price'] * $item['quantity'] }}</span></li>
            @endforeach
        </ul>

        @php
            $sum = 0;
            foreach ($cart as $item) {
                $sum += $item['price'] * $item['quantity'];
            }
        @endphp

        <p style="margin-top: 1rem; font-weight: bold;">£{{ $sum }}</p>
    </div>

    <a href="{{ route('registry.clear') }}" style="text-decoration: none;">
        <div class="clear-button">
            Remove all
        </div>
    </a>
</div>
@endsection
