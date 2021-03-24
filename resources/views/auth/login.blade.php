@extends('layouts.app-navbar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Autentificare') }}</div>

                <div class="card-body">
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

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Autentificare') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Ati uitat parola?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
