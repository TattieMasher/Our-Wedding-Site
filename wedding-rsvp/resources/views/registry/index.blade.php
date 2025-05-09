@extends('layouts.app')

@section('title', 'Alex & Candace - Gift Registry')

@section('content')
<div class="gift-intro">
    <p>Your presence is the best gift we could ask for!</p>
    <p>We’ve got all the “stuff” we need, but if you’d like to contribute to our new home fund, we’d be so grateful (no pressure, of course!). 💕</p>
</div>

<div class="gift-grid">
    @foreach($gifts as $gift)
        <div class="gift-card">
            <img src="{{ $gift['image'] }}" alt="{{ $gift['title'] }}">
            <h3>{{ $gift['title'] }}</h3>
            <p class="description">{{ $gift['description'] }}</p>
            <p class="price">£{{ $gift['price'] }}</p>
            <p class="remaining">{{ $gift['remaining'] }} remaining</p>

            <form method="POST" action="{{ route('cart.add') }}" class="add-to-cart-form">
                @csrf
                <input type="hidden" name="gift[title]" value="{{ $gift['title'] }}">
                <input type="hidden" name="gift[description]" value="{{ $gift['description'] }}">
                <input type="hidden" name="gift[price]" value="{{ $gift['price'] }}">
                <input type="hidden" name="gift[image]" value="{{ $gift['image'] }}">
                <input type="number" name="quantity" value="1" min="1" max="{{ $gift['remaining'] }}">

                <button type="submit" class="add-to-cart">Add to Cart</button>
            </form>
        </div>
    @endforeach
</div>

<a href="{{ route('registry.checkout') }}" class="floating-cart-button">
    View Cart & Checkout
</a>
@endsection
