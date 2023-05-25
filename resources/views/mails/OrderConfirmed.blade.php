<!DOCTYPE html>
<html>

<head>
  <title>Nuova richiesta in arrivo</title>
</head>

<body>
  <div>Grazie {{ $order->first_name }} per aver effettuato l'ordine!</h1>
    <p>
      I TUOI DATI:
    </p>
    <ul>
      <strong>Nome:</strong> {{ $order->customer_name }}
      </li>
      <li>
        <strong>Cognome:</strong> {{ $order->customer_surname }}
      </li>
      <li>
        <strong>Email:</strong> {{ $order->customer_mail }}
      </li>
      <li>
        <strong>Indirizzo:</strong> {{ $order->customer_address }}
      </li>
      <li>
        <strong>Telefono:</strong> {{ $order->customer_phone_number }}
      </li>
    </ul>
    <p>
      DI SEGUITO IL TUO RIEPILOGO:
    </p>
    <ul>
      @foreach ($dishes as $key => $dish)
        <li>
          <p>
            <strong>Nome:</strong> {{ $dish->name }}
          </p>
          <p>
            <strong>Prezzo:</strong> € {{ $dish->price }}
          </p>
          <p>
            <strong>Quantità:</strong> {{ $quantity[$key] }}
          </p>
        </li>
        <hr>
      @endforeach
      <li>
        <strong>Prezzo Totale:</strong> € {{ $order->total_amount }};
      </li>
    </ul>

  </div>
</body>

</html>
