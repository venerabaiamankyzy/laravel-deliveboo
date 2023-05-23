<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
        $order->total_amount = 30;
        $order->status = 0;

        // Salvo l'ordine
        $order->save();

        // Trasformo i piatti della richiesta in un'array
        $dishes = $data['dishes_id'];
        $dishesArray = explode(',', $dishes);

        // Trasformo la quantità della richiesta in un'array
        $quantity = $data['quantity'];
        $quantityArray = explode(',', $quantity);

        // Per ogni piatto attacco la quantità
        for ($i=0; $i < count($dishesArray); $i++) { 
            
            // Attacco l'id del piatto nella tabella ponte
            $order->dishes()->attach($dishesArray[$i], ['quantity' => $quantityArray[$i]]);
        }


        return url('http://localhost:5173/');
    }
}
