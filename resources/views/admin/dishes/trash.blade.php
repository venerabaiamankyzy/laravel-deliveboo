@extends('layouts.app')

@section('title', 'Cestino')

@section('actions')
  <div id="buttons" class="d-flex">
    <a href="{{ route('admin.dishes.index') }}" type="button" class="btn btn-primary text-white ms-auto">Torna alla
      lista</a>
  </div>
@endsection

@section('content')

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

            {{-- icon for delete --}}
            <a href="#" class="text-danger" data-bs-toggle="modal"
              data-bs-target="#delete-modal-{{ $dish->id }}">
              <i class="bi bi-trash3 btn-icon"></i>
            </a>
            {{-- icon for reset --}}
            <a href="#" class="text-success" data-bs-toggle="modal"
              data-bs-target="#restore-modal-{{ $dish->id }}">
              <i class="bi bi-arrow-repeat btn-icon fs-5"></i>
            </a>
          </td>
        </tr>
      @empty
        <tr>
          <td class="text-center" colspan="7">Nessun piatto trovato</td>
        </tr>
      @endforelse
    </tbody>
  </table>
@endsection

@section('modals')
  @forelse ($dishes as $dish)
    <!-- modal for delete-->
    <div class="modal modal-lg fade" id="delete-modal-{{ $dish->id }}" tabindex="-1"
      aria-labelledby="delete-modal-{{ $dish->id }}" aria-hidden="true" data-bs-backdrop="static"
      data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma eliminazione!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-start">
            Sei sicuro di voler eliminare definitivamente il piatto "{{ $dish->name }}" con ID
            "{{ $dish->id }}"? <br>
            L'operazione non è reversibile.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

            <form action="{{ route('admin.dishes.force-delete', $dish) }}" method="POST">
              @method('delete')
              @csrf

              <button type="submit" class="btn btn-danger">Elimina</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  @empty
  @endforelse
  {{-- modal for reset --}}
  @forelse ($dishes as $dish)
    <!-- Modal -->
    <div class="modal modal-lg fade" id="restore-modal-{{ $dish->id }}" tabindex="-1"
      aria-labelledby="restore-modal-{{ $dish->id }}" aria-hidden="true" data-bs-backdrop="static"
      data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Ripristina!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-start">
            Sei sicuro di voler ripristinare il piatto "{{ $dish->name }}" con ID "{{ $dish->id }}"?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annulla</button>

            <form action="{{ route('admin.dishes.restore', $dish) }}" method="POST">
              @method('put')
              @csrf

              <button type="submit" class="btn btn-success">Ripristina</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  @empty
  @endforelse
@endsection
