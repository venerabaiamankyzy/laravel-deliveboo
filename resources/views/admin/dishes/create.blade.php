@extends('layouts.app')

@section('content')
  <div class="container">
    <form class="mt-5" action="{{ route('admin.dishes.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      {{-- name
      description
      price
      photo
      is_visible --}}

      <div class="mb-4 row">
        <label for="name" class="col-md-4 col-form-label text-md-right">
          {{ __('Nome piatto') }}
        </label>

        <div class="col-md-6">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') }}" required autocomplete="name" autofocus>

          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="mb-4 row">
        <label for="description" class="col-md-4 col-form-label text-md-right">
          {{ __('Descrizione') }}
        </label>

        <div class="col-md-6">
          <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
            name="description" value="{{ old('description') }}" required autocomplete="description" autofocus></textarea>

          @error('description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="mb-4 row">
        <label for="price" class="col-md-4 col-form-label text-md-right">
          {{ __('Prezzo') }}
        </label>

        <div class="col-md-6">
          <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price"
            value="{{ old('price') }}" required autocomplete="price" autofocus>

          @error('price')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="mb-4 row">
        <div class="form-check">
          <label for="name" class="col-md-4 col-form-label text-md-right">
            {{ __('Visibile') }}
          </label>

          <div class="col-3">
            <input type="checkbox" id="is_visible" value="1" name="is_visible" class="form-check-control"
              {{ old('is_visible') }}>
            <label for="is_visible">Visibile</label>
          </div>

        </div>
      </div>

      <div class="mb-4 row">
        <label for="photo" class="col-md-4 col-form-label text-md-right">
          {{ __('Foto') }}
        </label>

        <div class="col-md-6">
          <input id="photo" type="text" class="form-control @error('photo') is-invalid @enderror" name="photo"
            value="{{ old('photo') }}" required autocomplete="photo" autofocus>

          @error('photo')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Crea</button>
    </form>
  </div>
@endsection
