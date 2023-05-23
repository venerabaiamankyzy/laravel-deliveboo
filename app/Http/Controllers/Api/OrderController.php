<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Dish;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Prendo tutti parametri della richiesta del form
        $data = $request->all();

        // Creo un nuovo ordine
        $order = new Order;

        // Riempio i dati dell'ordine
        $order->fill($data);
        $order->status = 0;

        // Trasformo i piatti della richiesta in un'array, togliendo però i caratteri '[' e ']'
        $dishes = str_replace(['[', ']'], '', $data['dishes_id']);
        $dishesArray = explode(',', $dishes);

        // Trasformo la quantità della richiesta in un'array, togliendo però i caratteri '[' e ']'
        $quantity = str_replace(['[', ']'], '', $data['quantity']);
        $quantityArray = explode(',', $quantity);

        // Recupera i prezzi dei piatti corrispondenti agli 'dish_id' forniti come parametro
        $dishPrices = Dish::whereIn('id', $dishesArray)->pluck('price', 'id')->toArray();

        // Calcola la somma totale dei prezzi dei piatti
        $totalAmount = 0;

        for ($i = 0; $i < count($dishesArray); $i++) {
            $dishId = $dishesArray[$i];
            $quantity = $quantityArray[$i];

            $dishPrice = $dishPrices[$dishId];
            $totalAmount += $dishPrice * $quantity;
        }

        // Assegna la somma totale dei prezzi a $order->total_amount
        $order->total_amount = $totalAmount;

        // Salvo l'ordine
        $order->save();

        // Per ogni piatto attacco la quantità
        for ($i=0; $i < count($dishesArray); $i++) { 
            
            // Attacco l'id del piatto nella tabella ponte
            $order->dishes()->attach($dishesArray[$i], ['quantity' => $quantityArray[$i]]);
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
