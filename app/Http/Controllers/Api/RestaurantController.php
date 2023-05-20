<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        // Carica la relazione "types" dei ristoranti
        $query = Restaurant::with('types');

        // Se nella request c'è il parametro 'types'
        if($request->has('types')) {

            // Ricevi i tipi selezionati dalla richiesta (Laravel accetta solo stringhe)
            $types = $request->input('types');
    
            // Converti la stringa dei tipi in un array
            $typesArray = explode(',', $types);
    
            // Applica i filtri dei tipi selezionati alla query
            if ($typesArray) {
                $query->whereHas('types', function ($q) use ($typesArray) {
                    $q->whereIn('type_id', $typesArray);
                });
            }
        }

        // Esegui la query per ottenere i ristoranti filtrati
        $restaurants = $query->paginate(9);

        // Risolve il path dell'immagine
        foreach ($restaurants as $restaurant) {
            if ($restaurant->photo) $restaurant->photo = $restaurant->getImageUri();
        };

        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }

    public function show($id)
    {
        $restaurant = Restaurant::where('id', $id)->with('dishes')->first();

        if (!$restaurant) return response(null, 404);

        // Foto assoluta ristorante
        $restaurant->photo = $restaurant->getImageUri();

        // Foto assoluta piatti
        foreach ($restaurant->dishes as $dish) {
            if ($dish->photo) $dish->photo = $dish->getImageUri();
        };

        return response()->json([
            'success' => true,
            'results' => $restaurant,
        ]);
    }
}
