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
                    'title' => 'Dinner Date',
                    'description' => 'Get us a romantic date together',
                    'price' => 60,
                    'image' => asset('images/dinner.jpg'),
                ],
                [
                    'title' => 'Other stuff?',
                    'description' => 'Any oda thingz mandem might wanna pay fur',
                    'price' => 175,
                    'image' => asset('images/hotel.jpg'),
                ],
            ],
            'House Fund' => [
                [
                    'title' => 'Furniture',
                    'description' => 'Get us some Ikea flatpack shite!',
                    'price' => 150,
                    'image' => asset('images/sofa.jpg'),
                ],
                [
                    'title' => 'Home Deposit Contribution',
                    'description' => 'Help us greatly with a contribution towards our first home',
                    'price' => 150,
                    'image' => asset('images/sofa.jpg'),
                ],
            ],
            'Wedding Costs' => [
                [
                    'title' => 'Photographer',
                    'description' => 'Help us Capture the moment!',
                    'price' => 50,
                    'image' => asset('images/photographer.jpg'),
                ],
            ],
            'Just Because' => [
                [
                    'title' => 'Surprise Us!',
                    'description' => 'Rando Orlando',
                    'price' => 20,
                    'image' => asset('images/surprise.jpg'),
                ],
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
