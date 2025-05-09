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
}
