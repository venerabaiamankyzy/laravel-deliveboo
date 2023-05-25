<!DOCTYPE html>
<html>

<head>
  <title>Nuova richiesta in arrivo</title>
</head>

<body>


  <div>
    <h1 class="text-center">Ciao {{ $restaurant->name }} hai appena ricevuto un nuovo ordine!</h1>

    <p>
      DATI DELL'ORDINE:
    </p>
    <ul>
      <li>
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
    <a href="{{ $order_link }}">Visualizza dettagli</a>
  </div>
</body>

</html>
