@extends('layouts.app')

@section('title', 'Aggiungi piatto')

@section('actions')
  <div class="d-flex gap-3">
    <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary text-white">
      <i class="bi bi-arrow-bar-left"></i>
      Torna alla lista</a>
    <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-success text-white ms-auto ">
      <i class="bi bi-brush"></i>
      Modifica</a>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-6 align-items-stretch d-flex">
      <div class="dish_details border border-dark p-4 w-100">
        <div class="mb-2 row">
          <span for="name" class="col-md-4 col-form-label text-md-right">
            {{ __('Nome piatto') }}
          </span>

          <div class="col-md-8">
            <p class="col-form-label">{{ $dish->name }}</p>
          </div>
        </div>
        <hr>
        <div class="mb-2 row">
          <span for="description" class="col-md-4 col-form-label text-md-right">
            {{ __('Descrizione') }}
          </span>

          <div class="col-md-8">
            <p class="col-form-label">{{ $dish->description }}</p>
          </div>
        </div>
        <hr>
        <div class="mb-2 row">
          <label for="price" class="col-md-4 col-form-label text-md-right">
            {{ __('Prezzo') }}
          </label>

          <div class="col-md-8">
            <p class="col-form-label">€{{ number_format((float) $dish->price, 2, '.', '') }}</p>
          </div>
        </div>
        <hr>
        <div class="mb-2 row">
          <label for="is_visible" class="col-md-4 col-form-label text-md-right">
            {{ __('Visibile') }}
          </label>

          <div class="col-3 d-flex align-items-center">
            <p class="col-form-label">
              @if ($dish->is_visible)
                <i class="bi bi-eye-fill text-success"></i>
              @else
                <i class="bi bi-eye-slash-fill text-danger"></i>
              @endif
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-6">
      <div class="row">
        <img src="{{ $dish->getImageUri() }}" alt="{{ $dish->name }}">
      </div>
    </div>
  </div>
@endsection
