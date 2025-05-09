<div>
    <div class="gift-intro">
        <p>Your presence is the best gift we could ask for!</p>
        <p>We’ve got all the “stuff” we need, but if you’d like to contribute to our new home fund, we’d be so grateful (no pressure, of course!). 💕</p>
    </div>

    @foreach($gifts as $category => $giftGroup)
        <div class="category-block">
            <h3 class="gift-category">{{ $category }}</h3>
            <div class="gift-grid">
                @foreach($giftGroup as $i => $gift)
                    <div class="gift-card">
                        <img src="{{ $gift['image'] }}" alt="{{-- $gift['title'] --}}">
                        <h4>{{ $gift['title'] }}</h4>
                        <p class="description">{{ $gift['description'] }}</p>
                        <p class="price">£{{ $gift['price'] }}</p>
                        <button wire:click="addToCart('{{ $gift['title'] }}')" class="add-to-cart">Add Gift</button>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    @if ($this->cartCount)
        <a href="{{ route('registry.checkout') }}" class="floating-cart-button">
            Send your gifts!
            @if ($this->cartCount)
                <span class="cart-badge">{{ $this->cartCount }}</span>
            @endif
        </a>
    @endif

    @if ($this->cartCount)
        <button wire:click="clearCart" class="clear-cart-button">
            Clear Selection
        </button>
    @endif
</div>
