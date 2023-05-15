@extends('layouts.app')

@section('content')
  {{-- @dd($dishes) --}}
  <div class="container">
    <div id="buttons" class="mt-5">
      <a href="{{ route('admin.dishes.create') }}" type="button" class="btn btn-primary">Crea Piatto</a>
    </div>

    <table class="table table-striped mt-2">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Descrizione</th>
          <th scope="col">Prezzo</th>
          <th scope="col">Visibile</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($dishes as $dish)
          <tr>
            <th scope="row">{{ $dish->id }}</th>
            <td>{{ $dish->name }}</td>
            <td>{{ $dish->description }}</td>
            <td>€{{ $dish->price }}</td>
            <td>{{ $dish->is_visible }}</td>
          </tr>
        @empty
          <tr>
            <td class="text-center" colspan="5">Nessun piatto trovato</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
