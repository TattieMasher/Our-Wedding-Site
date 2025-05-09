<?php

namespace App\Http\Controllers;

use App\Models\GiftContribution;
use Illuminate\Http\Request;

class RegistryController extends Controller
{
    public function index()
    {
        return view('registry.index');
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

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('registry.index');
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
