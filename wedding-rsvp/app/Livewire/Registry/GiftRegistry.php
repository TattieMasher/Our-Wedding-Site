<?php

namespace App\Livewire\Registry;

use Livewire\Component;

class GiftRegistry extends Component
{
    public array $gifts = [];
    public array $customGiftLabels = [];

    public function mount()
    {
        $this->gifts = [
            'Honeymoon' => [
                [
                    'title' => 'Dinner Date',
                    'description' => 'Get us a romantic date together',
                    'price' => 60,
                    'image' => asset('images/dinner.jpg'),
                ],
            ],
            'House Fund' => [
                [
                    'title' => 'Home Deposit Contribution',
                    'description' => 'Help us greatly with a contribution towards our first home',
                    'price' => 150,
                    'image' => asset('images/house.jpg'),
                ],
            ],
            'Just Because' => [
            ],
        ];

        $this->customGiftLabels = [
            'Honeymoon'     => [
                'title' => 'Honeymoon Contribution',
                'description' => 'Want to help us make our honeymoon extra special?',
                'image' => asset('images/honeymoon-custom.jpg'),
            ],
            'House Fund'    => [
                'title' => 'Other House Gift',
                'description' => 'Want to gift us something house-related?',
                'image' => asset('images/house-custom.jpg'),
            ],
            'Wedding Costs' => [
                'title' => 'Custom Wedding Gift',
                'description' => 'Want to help us towards some other wedding cost?',
                'image' => asset('images/justbecause-custom.jpg'),
            ],
            'Just Because'  => [
                'title' => 'Surprise Gift',
                'description' => 'Contribute towards something of your choosing!',
                'image' => asset('images/surprise-custom.jpg'),
            ],
        ];
    }

    public function addToCart($title, $quantity = 1)
    {
        $foundGift = null;

        foreach ($this->gifts as $category => $group) {
            foreach ($group as $gift) {
                if ($gift['title'] === $title) {
                    $foundGift = $gift;
                    break 2;
                }
            }
        }

        if (!$foundGift) {
            return;
        }

        $cart = session()->get('cart', []);
        $key = $foundGift['title'];

        if (!isset($cart[$key])) {
            $cart[$key] = $foundGift;
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
