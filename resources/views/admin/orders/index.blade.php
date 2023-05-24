@extends('layouts.app')

@section('title', 'Lista Ordini')


@section('content')
  <div class="container">

    <ul>
      @foreach ($orders as $order)
        @foreach ($order->dishes as $dish)
          @dd($dish->pivot->quantity)
        @endforeach
        <li>{{ $order->customer_name }} , {{ $order->customer_surname }}, €{{ $order->dishes }}</li>
      @endforeach
    </ul>

  </div>
@endsection
