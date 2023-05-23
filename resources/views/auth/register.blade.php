@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Registrazione') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
              @csrf

              <h3 class="mb-4 regist-color">Registrazione ristoratore</h3>

              <div class="mb-4 row">
                <label for="name" class="col-md-4 col-form-label text-md-right">
                  {{ __('Nome titolare') }}
                </label>

                <div class="col-md-8">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo email') }}</label>

                <div class="col-md-8">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-8">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">
                <label for="password-confirm"
                  class="col-md-4 col-form-label text-md-right">{{ __('Conferma password') }}</label>

                <div class="col-md-8">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
                </div>
              </div>

              <h3 class="my-4 regist-color">Registrazione ristorante</h3>

              <div class="mb-4 row">
                <label for="company_name" class="col-md-4 col-form-label text-md-right">
                  {{ __('Nome attività') }}
                </label>

                <div class="col-md-8">
                  <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror"
                    name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>

                  @error('company_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">
                <label for="address" class="col-md-4 col-form-label text-md-right">
                  {{ __('Indirizzo attività') }}
                </label>

                <div class="col-md-8">
                  <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                    name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                  @error('address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">
                <label for="vat_number" class="col-md-4 col-form-label text-md-right">
                  {{ __('Partita IVA') }}
                </label>

                <div class="col-md-8">
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">IT</span>
                    <input id="vat_number" type="text" maxlength="11"
                      class="form-control @error('vat_number') is-invalid @enderror" name="vat_number"
                      value="{{ old('vat_number') }}" required autocomplete="vat_number" autofocus>

                    @error('vat_number')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="mb-4 row">
              
                  <label for="name" class="col-md-4 col-form-label text-md-right">
                    {{ __('Tipologia') }}
                  </label>

                  <div class="col-md-8 d-flex flex-wrap">
                    @foreach ($types as $type)
                      <div class="col-3 my-1">
                        <input type="checkbox" id="types-{{ $type->id }}" value="{{ $type->id }}"
                          name="types[]" class="form-check-input" @if (in_array($type->id, old('types', $restaurant_type ?? []))) checked @endif>
                        <label for="types-{{ $type->id }}">{{ $type->name }}</label>
                      </div>
                    @endforeach
                  </div>

                  @error('types')
                    <span class="invalid-feedback d-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                
              </div>

              <div class="mb-4 row">
                <label for="phone_number" class="col-md-4 col-form-label text-md-right">
                  {{ __('Numero di telefono') }}
                </label>

                <div class="col-md-8">
                  <input id="phone_number" type="text" maxlength="11"
                    class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                    value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                  @error('phone_number')
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

                <div class="col-md-8">
                  <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                    name="description" value="{{ old('description') }}" autocomplete="description" autofocus rows="10"></textarea>

                  @error('description')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">
                <label for="photo" class="col-md-4 col-form-label text-md-right">
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
              </div>

              <div class="mb-4 row">
                <div class="d-flex">
                  <button type="submit" class="btn btn-primary ms-auto">
                    {{ __('Registrati') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
