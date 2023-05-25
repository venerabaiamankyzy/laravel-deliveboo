<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Dish;
use Braintree\Configuration;
use Braintree\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
{
    // Prendo tutti parametri della richiesta del form
    $data = $request->all();
    

    // Messaggi di errore personalizzati
    $messages = [
        'customer_name.required' => 'Il campo nome è obbligatorio.',
        'customer_surname.required' => 'Il campo cognome è obbligatorio.',
        'customer_mail.required' => 'Il campo email è obbligatorio.',
        'customer_mail.email' => 'Il campo email deve essere un indirizzo email valido.',
        'customer_phone_number.required' => 'Il campo numero di telefono è obbligatorio.',
        'customer_phone_number.numeric' => 'Il campo numero di telefono deve essere un numero.',
        'customer_address.required' => 'Il campo indirizzo è obbligatorio.',
    ];

    // Regole di validazione
    $rules = [
        'customer_name' => 'required',
        'customer_surname' => 'required',
        'customer_mail' => 'required|email',
        'customer_phone_number' => 'required|numeric',
        'customer_address' => 'required',
    ];

    // Esegui la validazione dei dati
    $validator = Validator::make($data, $rules, $messages);

    // Controlla se la validazione ha avuto successo
    if ($validator->fails()) {
        // Se la validazione non è passata, restituisci gli errori
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    // Configura le chiavi di autenticazione di Braintree
    Configuration::environment('sandbox'); // Imposta l'ambiente a "sandbox" per i test, usa "production" per l'ambiente di produzione
    Configuration::merchantId('7dzbnc5wqqzwztpw');
    Configuration::publicKey('tbtgjpj9v8tftcz9');
    Configuration::privateKey('bedea09f0f47c18d542b4ff3fe8681f7');

    // Effettua la convalida del payload.nonce utilizzando Braintree
    $result = Transaction::sale([
        'amount' => '0.01', // Importo dell'operazione
        'paymentMethodNonce' => $data['nonce'], // Modifica il campo per accedere direttamente a 'nonce'
        'options' => [
            'submitForSettlement' => true // Invia la transazione per l'elaborazione immediata
        ]
    ]);

    if ($result->success) {
        // La transazione è stata completata con successo
        // Continua con la logica dell'ordine

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
        for ($i = 0; $i < count($dishesArray); $i++) {
            // Attacco l'id del piatto nella tabella ponte
            $order->dishes()->attach($dishesArray[$i], ['quantity' => $quantityArray[$i]]);
        }

        return response()->json([
            'success' => true,
        ]);
    } else {
        // La transazione non è stata completata
        $errors = $result->errors->deepAll();

        return response()->json([
            'success' => false,
            'payload.nonce' => false,
            'errors' => $errors,
        ], 422);
    }
}
}
