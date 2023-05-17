@extends('layouts.app')

@section('title', 'Modifica piatto')

@section('actions')
	<div class="my-4">
		<a 
			href="{{ route('admin.dishes.index') }}" type="submit" class="btn btn-primary ms-auto">
			<i class="bi bi-arrow-bar-left"></i>
				Torna alla lista
		</a>
	</div>
@endsection

@section('content')
    <div class="container">
        <form class="mt-2 mb-4 border border-dark p-4" action="{{ route('admin.dishes.update', $dish) }}" method="post"
            enctype="multipart/form-data" style="background-color: #f5f5f5">
            @csrf
            @method('PUT')

            <div class="mb-2 row">
                <label for="name" class="col-md-2 col-form-label text-md-right">
                    {{ __('Nome piatto') }}
                </label>

                <div class="col-md-10">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ $dish->name, old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <hr>
            <div class="mb-2 row">
                <label for="description" class="col-md-2 col-form-label text-md-right">
                    {{ __('Descrizione') }}
                </label>

                <div class="col-md-10">
                    <textarea id="description" type="text" rows="5" class="form-control @error('description') is-invalid @enderror"
                        name="description" required autocomplete="description" autofocus>{{ $dish->description, old('description') }}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <hr>
            <div class="mb-2 row">
                <label for="price" class="col-md-2 col-form-label text-md-right">
                    {{ __('Prezzo') }}
                </label>

                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text">€</span>
                        <input id="price" type="number" step="0.01"
                            class="form-control @error('price') is-invalid @enderror" name="price"
                            value="{{ $dish->price, old('price') }}" required autocomplete="price" autofocus min="0"
                            oninput="value == '' ? value = '' : value < 0 ? value = value * -1 : false">
                    </div>

                    @error('price')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <hr>
            <div class="mb-2 row">
                <label for="is_visible" class="col-md-2 col-form-label text-md-right">
                    {{ __('Visibile') }}
                </label>

                <div class="col-3 d-flex align-items-center">
                    <input type="checkbox" id="is_visible" value="1" name="is_visible" class="form-check-control"
                        @if (old('is_visible') || $dish->is_visible) checked @endif>
                </div>
            </div>
            <hr>
            <div class="mb-2 row">
                <label for="photo" class="col-md-2 col-form-label text-md-right">
                    {{ __('Foto') }}
                </label>

                <div class="col-md-8">
                    <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror"
                        name="photo">

                    @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-2 text-center">
                    <label for="current-image" class="form-label text-md-right">Current Image</label>
                    <img src="{{ $dish->getImageUri() }}" name="current-image" alt="dishe-image" class="form-box-img"
                        style="max-width: 100%">
                </div>
            </div>

            <div class="d-flex mt-3">
                <button type="submit" class="btn btn-warning ms-auto">
                    Modifica
                    <i class="bi bi-brush"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
