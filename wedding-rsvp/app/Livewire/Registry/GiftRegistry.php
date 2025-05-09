<?php

namespace App\Livewire\Registry;

use Livewire\Component;

class GiftRegistry extends Component
{
    public array $gifts = [];

    public function mount()
    {
        $this->gifts = [
            'Honeymoon' => [
                [
                    'title' => 'Round-Trip Airfare',
                    'description' => 'Our international flights to Greece and back',
                    'price' => 200,
                    'remaining' => 10,
                    'image' => asset('images/airfare.jpg'),
                ],
                [
                    'title' => 'Hotel Accommodations',
                    'description' => 'We’ll be staying at lovely seaside resorts',
                    'price' => 175,
                    'remaining' => 8,
                    'image' => asset('images/hotel.jpg'),
                ],
            ],
            'House Fund' => [
                [
                    'title' => 'Living Room Furniture',
                    'description' => 'Help us make our new flat a home',
                    'price' => 150,
                    'remaining' => 5,
                    'image' => asset('images/sofa.jpg'),
                ],
                [
                    'title' => 'Kitchen Appliances',
                    'description' => 'We’re dreaming of that air fryer life',
                    'price' => 75,
                    'remaining' => 6,
                    'image' => asset('images/kitchen.jpg'),
                ],
            ],
            'Wedding Costs' => [
                [
                    'title' => 'Photography Package',
                    'description' => 'Capturing the day forever',
                    'price' => 120,
                    'remaining' => 2,
                    'image' => asset('images/photographer.jpg'),
                ],
            ],
            'Just Because' => [
                [
                    'title' => 'Surprise Us!',
                    'description' => 'A little treat from you to us ❤️',
                    'price' => 20,
                    'remaining' => 20,
                    'image' => asset('images/surprise.jpg'),
                ],
            ],
        ];
    }

    public function addToCart($index, $quantity = 1)
    {
        $gift = $this->gifts[$index];
        $cart = session()->get('cart', []);
        $key = $gift['title'];

        if (!isset($cart[$key])) {
            $cart[$key] = $gift;
            $cart[$key]['quantity'] = $quantity;
        } else {
            $cart[$key]['quantity'] += $quantity;
        }

        session()->put('cart', $cart);
    }

    public function getCartCountProperty()
    {
        return collect(session('cart', []))->sum('quantity');
    }

    public function render()
    {
        return view('livewire.registry.gift-registry');
    }
}
