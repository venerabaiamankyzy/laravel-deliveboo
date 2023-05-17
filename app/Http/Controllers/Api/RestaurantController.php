<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index() {
        $restaurants = Restaurant::with('types')->paginate(9);

        foreach($restaurants as $restaurant) {
            if ($restaurant->photo) $restaurant->photo = $restaurant->getImageUri();
        };

        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }
}
