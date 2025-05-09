<?php

namespace App\Http\Controllers;

use App\Models\GiftContribution;
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

    public function submitContribution(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string|max:1000',
            'amount' => 'required|integer',
            'items' => 'required|json',
        ]);

        // Save to DB
        GiftContribution::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'amount' => $validated['amount'],
            'items' => json_decode($validated['items'], true),
        ]);

        session()->forget('cart');

        // Generate PayPal note
        $items = collect(json_decode($validated['items'], true));
        $note = $items->map(fn($i) => "{$i['title']} (£" . ($i['price'] * $i['quantity']) . ")")->join(', ');
        if (!empty($validated['message'])) {
            $note .= " - Message: " . $validated['message'];
        }

        // Build redirect URL
        $paypalUrl = 'https://paypal.me/McCaughranWedding/' . $validated['amount'];
        $paypalUrl .= '?note=' . urlencode($note);

        return redirect()->away($paypalUrl);
    }
}
