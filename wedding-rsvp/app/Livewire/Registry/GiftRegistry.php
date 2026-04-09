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
                [
                    'title' => 'Couples Massage',
                    'description' => 'Relaxing spa time',
                    'price' => 90,
                    'image' => asset('images/massage.jpg'),
                ],
                [
                    'title' => 'Sunset Cocktails',
                    'description' => 'A couple of fancy drinks to toast the evening',
                    'price' => 30,
                    'image' => asset('images/cocktails.jpg'),
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
            'Wedding' => [
                [
                    'title' => 'Wedding Cake',
                    'description' => 'Help us with the cost of our wedding cake',
                    'price' => 100,
                    'image' => asset('images/cake.jpg'),
                ],
                [
                    'title' => 'Photographer',
                    'description' => 'Help us capture the big day!',
                    'price' => 80,
                    'image' => asset('images/photographer.jpg'),
                ],
            ],
            'Just Because' => [
            ],
        ];

        $this->customGiftLabels = [
            'Honeymoon'     => [
                'title' => 'Honeymoon Surprise',
                'description' => 'Want to help us make our honeymoon extra special?',
                'image' => asset('images/honeymoon-custom.jpg'),
            ],
            'House Fund'    => [
                'title' => 'Other House Gift',
                'description' => 'Want to gift us something house-related?',
                'image' => asset('images/house-custom.jpg'),
            ],
            'Wedding Costs' => [
                'title' => 'Other Wedding Gift',
                'description' => 'Want to help us towards some other wedding cost?',
                'image' => asset('images/wedding-surprise.jpg'),
            ],
            'Just Because'  => [
                'title' => 'Surprise',
                'description' => 'Pick something special - it’s entirely up to you!',
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
