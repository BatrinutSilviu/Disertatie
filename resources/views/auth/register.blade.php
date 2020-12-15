@extends('layouts.app-navbar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inregistrare') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                       <div class="input-group mb-3 col-md-6 offset-md-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Nume</span>
                            </div>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                        </div>
                        </div>

                        <div class="form-group row">
                       <div class="input-group mb-3 col-md-6 offset-md-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Adresa Email</span>
                            </div>
                            <input type="text" class="form-control" name="email" value="{{old('email')}}" required>
                        </div>
                        </div>

                        <div class="form-group row">
                       <div class="input-group mb-3 col-md-6 offset-md-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Parola</span>
                            </div>
                            <input type="text" class="form-control" name="password" value="{{old('password')}}" required>
                        </div>
                        </div>

                        <div class="form-group row">
                       <div class="input-group mb-3 col-md-6 offset-md-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Confirma Parola</span>
                            </div>
                            <input type="text" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}" required>
                        </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Inregistrare') }}
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
