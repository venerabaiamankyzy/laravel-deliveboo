@extends('layouts.app')

@section('title', 'Lista ordini in corso')

@section('actions')
  <a href="{{ route('admin.orders.completed') }}" class="btn btn-success text-white">
    Ordini completati</a>
@endsection

@section('content')
  <table class="table table-striped mt-2 border border-dark">
    <thead>
      <tr>
        <th scope="col">Nome e Cognome</th>
        <th scope="col">Email</th>
        <th scope="col">Telefono</th>
        <th scope="col">Indirizzo</th>
        <th scope="col">Totale ordine</th>
        <th scope="col">Data ordine</th>
        <th scope="col" class="text-center">Stato</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @forelse ($orders as $order)
        <tr>
          <th>{{ $order->customer_name }} {{ $order->customer_surname }}</th>
          <td>{{ $order->customer_mail }}</td>
          <td>{{ $order->customer_phone_number }}</td>
          <td>{{ $order->customer_address }}</td>
          <td>€ {{ number_format((float) $order->total_amount, 2, '.', '') }}</td>
          <td>{{ $order->formatted_created_at }}</td>
          <td class="text-center">
            @if ($order->status == 0)
              <span class="badge rounded-pill text-bg-warning">In corso</span>
            @else
              <span class="badge rounded-pill text-bg-success text-white">Completato</span>
            @endif
          </td>
          {{-- <td>{{ $order->status }}</td> --}}
          <td><a href="{{ route('admin.orders.show', $order->id) }}" class="p-0 border-0"
              style="color: #0d6efd">Visualizza
              ordine</a></td>
        </tr>
      @empty
        <tr>
          <td class="text-center" colspan="8">Non ci sono ordini in corso.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  {{ $orders->links('pagination::bootstrap-5') }}
@endsection
