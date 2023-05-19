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

    public function show($id) {
        $restaurant = Restaurant::where('id', $id)->with('dishes')->first();

        if(!$restaurant) return response(null, 404);

        // Foto assoluta ristorante
        $restaurant->photo = $restaurant->getImageUri();

        // Foto assoluta piatti
        foreach($restaurant->dishes as $dish) {
            if ($dish->photo) $dish->photo = $dish->getImageUri();
        };

        return response()->json([
            'success' => true,
            'results' => $restaurant,
        ]);
    }
}
