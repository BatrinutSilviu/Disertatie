@extends('layouts.app-navbar')

@section('content')
<div class="custom_container custom_panel" align="center">      
    <h1 class="titlu text-center" style="margin-bottom: 5%">Inregistrare</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group row">
            <div class="input-group mb-3 col-md-6 offset-md-3">
                <span class="titlu" style="font-size: 24px">Tipul echipei</span>
                <input name="toggler" class="pl-3" id="toggler" type="checkbox" data-toggle="toggle" data-on="Cluburi" data-off="Nationale" checked>
            </div>
        </div>
        
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
                <input type="password" class="form-control" name="password" value="{{old('password')}}" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3 col-md-6 offset-md-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Confirma Parola</span>
                </div>
                <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3 col-md-6 offset-md-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Echipa</span>
                </div>
                <input type="text" name="echipa" id="cauta_echipa" class="form-control" placeholder="Cauta echipa" value="{{old('echipa')}}" />
            </div>
        </div>

        <div align="center">
            <button type="submit" class="btn btn-primary">
                {{ __('Inregistrare') }}
            </button>
        </div>
    </form>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="Stylesheet" />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
function cautaCluburi() {
    $("#cauta_echipa").autocomplete({
        source: function(request, response) {
             $.ajax({
                url:"{{ route('echipa.cauta') }}",
                method:'GET',
                dataType:'json',
                data: {
                    search: request.term
                },
                success:function(data) {
                    response(data);
                }
            })
        }
    });
}

function cautaNationale() {
    $("#cauta_echipa").autocomplete({
        source: function(request, response) {
             $.ajax({
                url:"{{ route('nationala.cauta') }}",
                method:'GET',
                dataType:'json',
                data: {
                    search: request.term
                },
                success:function(data) {
                    response(data);
                }
            })
        }
    });
}

$(document).ready(function(){
    cautaCluburi();

    $('#toggler').on('change', function() {
        if (this.checked) {
            cautaCluburi();
        } else {
            cautaNationale();
        }
    });
});
</script>
@endsection
