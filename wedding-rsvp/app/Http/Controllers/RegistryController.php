<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistryController extends Controller
{
    public function index()
    {
        $gifts = [
            [
                'title' => 'Round-Trip Airfare',
                'description' => 'Our international flights to Greece and back',
                'price' => 200,
                'remaining' => 10,
                'image' => asset('images/airfare.jpg'),
            ],
            [
                'title' => 'Inter-Island Transportation',
                'description' => 'We\'re going to visit a few of the islands on our trip',
                'price' => 25,
                'remaining' => 8,
                'image' => asset('images/ferry.jpg'),
            ],
            [
                'title' => 'Hotel Accommodations',
                'description' => 'We\'ll be staying at a few different hotels along our journey',
                'price' => 175,
                'remaining' => 12,
                'image' => asset('images/hotel.jpg'),
            ],
        ];

        return view('registry.index', compact('gifts'));
    }

    public function addToCart(Request $request)
    {
        $gift = $request->input('gift');
        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);
        $key = $gift['title']; // Assuming titles are unique

        if (!isset($cart[$key])) {
            $cart[$key] = $gift;
            $cart[$key]['quantity'] = $quantity;
        } else {
            $cart[$key]['quantity'] += $quantity;
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Gift added!');
    }

    public function checkout()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('registry.checkout', compact('cart', 'total'));
    }
}
