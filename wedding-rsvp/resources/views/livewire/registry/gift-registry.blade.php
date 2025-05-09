<div>
    <div class="gift-intro">
        <p>Your presence is the best gift we could ask for!</p>
        <p>We’ve got all the “stuff” we need, but if you’d like to contribute to our new home fund, we’d be so grateful (no pressure, of course!). 💕</p>
    </div>

    <div class="gift-grid">
        @foreach($gifts as $i => $gift)
            <div class="gift-card">
                <img src="{{ $gift['image'] }}" alt="{{ $gift['title'] }}">
                <h3>{{ $gift['title'] }}</h3>
                <p class="description">{{ $gift['description'] }}</p>
                <p class="price">£{{ $gift['price'] }}</p>
                <p class="remaining">{{ $gift['remaining'] }} remaining</p>

                <button wire:click="addToCart({{ $i }})" class="add-to-cart">
                    Add to Cart
                </button>
            </div>
        @endforeach
    </div>

    <a href="{{ route('registry.checkout') }}" class="floating-cart-button">
        Send your gifts!
        @if ($this->cartCount)
            <span class="cart-badge">{{ $this->cartCount }}</span>
        @endif
    </a>
</div>
