@extends('layouts.app')

@section('content')
  {{-- @dd($dishes) --}}
  <div class="container">
    <h2 class="mt-4">Lista piatti</h2>

    <div id="buttons" class="d-flex my-4">
      <a href="{{ route('admin.dishes.create') }}" type="button" class="btn btn-success ms-auto">Aggiungi piatto</a>
    </div>

    <table class="table table-striped mt-2 border border-dark">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Descrizione</th>
          <th scope="col">Prezzo</th>
          <th scope="col">Ultima modifica</th>
          <th scope="col" class="text-center">Visibile</th>
          <th scope="col" class="text-end">Azioni</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($dishes as $dish)
          <tr>
            <th scope="row">{{ $dish->id }}</th>
            <td>{{ $dish->name }}</td>
            <td>{{ $dish->getAbstract() }}</td>
            <td>€{{ number_format((float) $dish->price, 2, '.', '') }}</td>
            <td>{{ $dish->updated_at }}</td>
            <td class="text-center">
              @if ($dish->is_visible)
                <i class="bi bi-eye-fill text-success"></i>
              @else
                <i class="bi bi-eye-slash-fill text-danger"></i>
              @endif
            </td>
            <td class="text-end">
              <a href="{{ route('admin.dishes.show', $dish->id) }}"
                class="bi bi-box-arrow-in-up-right btn btn-link p-0 border-0"></a>
              <a href="{{ route('admin.dishes.edit', $dish->id) }}"
                class="bi bi-brush btn btn-link p-0 border-0 ms-1"></a>
              <a type="button" class="btn btn-link p-0 border-0 ms-3"><i class="bi bi-trash text-danger"></i></a>
            </td>
          </tr>
        @empty
          <tr>
            <td class="text-center" colspan="7">Nessun piatto trovato</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
