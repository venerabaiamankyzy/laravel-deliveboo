@extends('layouts.app')

@section('content')
  <div class="container m-auto mt-5">
    <div class="row align-items-center rounded-2 border login mb-4">
      <div class="login-head col-12 col-lg-6">
        {{-- <img src="{{ asset('img/photo-restaurant.jpg') }}" class="img-fluid rounded-start" alt="restaurant-image"> --}}
      </div>

      <div class="login-body col-12 col-lg-6">
        <div class="logo-img text-center ">
          <h3 class="py-3">Bentornato!</h3>
          <img src="{{ asset('img//logo-primary.png') }}" class="img-fluid w-25 rounded-2" alt="logo">
        </div>
        <form method="POST" action="{{ route('login') }}" class="">
          @csrf
          <div class="row mx-4 mb-4">
            <label for="email" class="col-form-label text-md-right fw-semibold ">{{ __('Email') }}</label>

            <div>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="mb-4 mx-4 row">
            <div class="password">
              <label for="password" class="col-form-label text-md-right fw-semibold">{{ __('Password') }}
              </label>

              <div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" required autocomplete="current-password">

                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>



          </div>

          <div class="mb-4 mx-4 row">
            <div class="">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                  {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                  {{ __('Mantieni la sessione') }}
                </label>
              </div>
            </div>
          </div>

          <div class="mb-4 mx-4 row">
            <button type="submit" class="btn btn-primary main-color text-white">
              {{ __('Accedi') }}
            </button>

            @if (Route::has('password.request'))
              <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Hai dimenticato la password?') }}
              </a>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
