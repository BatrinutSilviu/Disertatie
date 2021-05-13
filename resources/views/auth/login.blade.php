@extends('layouts.app-navbar')

@section('content')
<div class="custom_container custom_panel" align="center">      
    <h1 class="titlu text-center" style="margin-bottom: 5%">{{ __('Autentificare') }}</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
        <div class="input-group mb-3 col-md-6 offset-md-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Adresa email</span>
            </div>
            <input type="text" class="form-control" name="email" value="{{old('email')}}" required>
        </div>
        </div>

        <div class="form-group row">
        <div class="input-group mb-3 col-md-6 offset-md-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Parola</span>
            </div>
            <input type="password" class="form-control" name="password" value="{{old('password')}}" required>
        </div>
        </div>

        <div align="center">
            <div class="form-check">
                <input class="form-check-input mt-2 mb-3" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label mt-2 mb-3" for="remember">
                    {{ __('Tine-ma minte') }}
                </label>
            </div>
        </div>

        <div align="center">
            <button type="submit" class="btn btn-primary">
                {{ __('Autentificare') }}
            </button>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Ati uitat parola?') }}
                </a>
            @endif
        </div>
    </form>
</div>
@endsection
