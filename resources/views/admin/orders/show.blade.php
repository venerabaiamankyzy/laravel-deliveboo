@extends('layouts.app')

@section('title', 'Lista Ordini')


@section('content')
  <div class="row mt-2 gx-4 gy-4 gy-lg-0">
    <!-- Box form dati utente -->
    <div class="col-12 col-lg-6">
      <div class="form-content border rounded-3 h-100">
        <div class="form-title p-3">
          <h3 class="m-0">Dati cliente</h3>
        </div>

        <hr class="m-0" />

        <div class="p-3">
          <div class="mb-3">
            <span class="fw-bold">ID: </span>
            <span>{{ $order->id }}</span>
          </div>
          <div class="mb-3">
            <span class="fw-bold">Nome e cognome: </span>
            <span>{{ $order->customer_name }} {{ $order->customer_surname }}</span>
          </div>
          <div class="mb-3">
            <span class="fw-bold">Email: </span>
            <span>{{ $order->customer_mail }}</span>
          </div>
          <div class="mb-3">
            <span class="fw-bold">Telefono: </span>
            <span>{{ $order->customer_phone_number }}</span>
          </div>
          <div class="mb-3">
            <span class="fw-bold">Indirizzo: </span>
            <span>{{ $order->customer_address }}</span>
          </div>
          <div class="mb-3">
            <span class="fw-bold">Totale ordine: </span>
            <span>€ {{ number_format((float) $order->total_amount, 2, '.', '') }}</span>
          </div>
          <div class="mb-3">
            <span class="fw-bold">Data ordine: </span>
            <span>{{ $order->created_at }}</span>
          </div>
          <div class="mb-3">
            <span class="fw-bold">Status: </span>
            <span>{{ $order->status }}</span>
          </div>
          <div class="mb-3">
            <span class="fw-bold">Note: </span>
            <span style="line-break: anywhere;">{{ $order->note }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Box prodotti nel carrello -->
    <div class="col-12 col-lg-6">
      <div class="form-content border h-100 rounded-3">
        <div class="form-title p-3">
          <h3 class="m-0">Riepilogo ordine</h3>
        </div>

        <hr class="m-0" />

        <div class="order-items-content d-flex flex-column p-3 gap-3">
          <table class="table table-striped mt-2 border border-dark">
            <thead>
              <tr>
                <th scope="col">Piatto</th>
                <th scope="col">Quantità</th>
              </tr>
            </thead>
            @foreach ($order->dishes as $dish)
              <tr>
                <td>{{ $dish->name }}</td>
                <td>{{ $dish->pivot->quantity }}</td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  @endsection
