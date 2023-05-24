@extends('layouts.app')

@section('title', 'Lista Ordini')


@section('content')
    <div class="container">

        <ul>
            @foreach ($orders as $order)
                {{-- @dd($order) --}}
                <li>{{ $order->customer_name }} , {{ $order->customer_surname }}, €{{ $order->dish_id }}</li>
            @endforeach
        </ul>

    </div>
@endsection
