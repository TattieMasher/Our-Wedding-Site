<div>
    <div class="gift-intro">
    <h4>Our Wedding Fund</h4>
    <p>
        Your love, support, and presence on our big day is the <u>most important gift</u> to us.<br><br>
        We don't have a gift registry, we're lucky to have all we currently need.<br><br>
        If you do wish to give something, a contribution to our future home or honeymoon experience would be deeply appreciated.<br><br>
        But please know: there's absolutely no expectation. Just having you with us is more than enough!<br>
    </p>
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
                @php
                    $custom = $this->customGiftLabels[$category] ?? [
                        'title' => "Other {$category} Gift",
                        'description' => "Want to help us towards some other " . strtolower($category) . " cost?",
                    ];
                @endphp

                <div class="custom-gift-card">
                    <h4>{{ $custom['title'] }}</h4>
                    <p class="description">{{ $custom['description'] }}</p>
                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="gift[title]" value="{{ $custom['title'] }}">
                        <input type="hidden" name="gift[description]" value="{{ $custom['description'] }}">
                        <input type="hidden" name="gift[image]" value="{{ asset('images/custom.jpg') }}">
                        <input type="number" name="gift[price]" min="1" placeholder="£ amount" required>
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="add-to-cart-button">Add Custom Gift</button>
                    </form>
                </div>
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
