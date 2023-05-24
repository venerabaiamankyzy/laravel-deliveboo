@extends('layouts.app')

@section('title', 'Lista Ordini')


@section('content')
  <div class="container">

    <table class="table table-striped mt-2 border border-dark">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome e Cognome</th>
          <th scope="col">Email</th>
          <th scope="col">Telefono</th>
          <th scope="col">Indirizzo</th>
          <th scope="col">Totale ordine</th>
          <th scope="col">Data ordine</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($orders as $order)
          <tr>
            <th scope="row">{{ $order->id }}</th>
            <td>{{ $order->customer_name }} {{ $order->customer_surname }}</td>
            <td>{{ $order->customer_mail }}</td>
            <td>{{ $order->customer_phone_number }}</td>
            <td>{{ $order->customer_address }}</td>
            <td>€ {{ $order->total_amount }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->status }}</td>
          </tr>
        @empty
          <tr>
            <td class="text-center" colspan="8">Nessun Ordine</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {{ $orders->links('pagination::bootstrap-5') }}
  </div>
@endsection
