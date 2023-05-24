@extends('layouts.app')

@section('title', 'Lista Ordini')


@section('content')
    <div class="container">
        <div class="row mt-2 gx-4 gy-4 gy-lg-0">

            <!-- Box dati cliente (ordine) -->
            <div class="col-12 col-lg-6">
                <div class="form-content border h-100 rounded-3">
                    <div class="form-title p-3">
                        <h3 class="m-0">Dati Ordine</h3>
                        <hr class="m-0" />
                        <p class="bold">ID:{{ $order->id }} </p>
                        <p class="bold">Nome e Cognome:{{ $order->customer_name }} {{ $order->customer_surname }}</p>
                        <p class="bold">Email:{{ $order->customer_mail }} </p>
                        <p class="bold">Telefono:{{ $order->customer_phone_number }} </p>
                        <p class="bold">Indirizzo:{{ $order->customer_address }} </p>
                        <p class="bold">Totale ordine:€ {{ number_format((float) $order->total_amount, 2, '.', '') }} </p>
                        <p class="bold">Data ordine:{{ $order->created_at }} </p>
                        <p class="bold">Status:{{ $order->status }} </p>
                    </div>



                    <!-- Box riepilogo ordine (piatti) -->
                    <div class="col-12 col-lg-6">
                        <div class="order-items-content d-flex flex-column p-3 gap-3">
                            @foreach ($order->dishes as $dish)
                                <div class="card">
                                    <div class="row card-row">
                                        <div class="col-8 h-100 ps-0">
                                            <div class="card-body d-flex align-items-center h-100 ps-0">
                                                <div class="card-details">
                                                    <h5 class="card-title m-0">{{ $dish->name }}</h5>
                                                    <p class="card-text m-0">{{ $dish->pivot->quantity }} </p>
                                                    <span class="text-primary fw-bold me-2 d-block d-sm-none"></span>
                                                </div>

                                                <div class="item-price-delete d-flex align-items-center ms-auto">
                                                    <span class="text-primary fw-bold me-2 d-none d-sm-block"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
