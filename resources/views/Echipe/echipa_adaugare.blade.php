@extends('layouts.app-navbar')

@section('content')	
<div class="custom_container custom_panel" align="center">	
	<h1 class="titlu text-center">
		<span class="material-icons edit-icon">emoji_events</span>
		Adaugare echipa
		<span class="material-icons edit-icon">emoji_events</span>
	</h1>
	<form method="POST" action="/echipa">
		{{ csrf_field() }}

		<div class="input-group mb-3 col-5 control">
			<div class="input-group-prepend">
				<span class="input-group-text">Nume</span>
			</div>
			<input type="text" class="form-control" name="Nume" value="{{old('Nume')}}" required>
		</div>

		<div class="input-group mb-3 col-5">
			<div class="input-group-prepend">
				<span class="input-group-text">Tara</span>
			</div>
			<input id="cauta_tara" type="text" class="form-control" name="Tara" value="{{old('Tara')}}" required>
		</div>

		<div class="input-group mb-3 col-5">
			<div class="input-group-prepend">
				<span class="input-group-text">Liga</span>
			</div>
			<input type="text" class="form-control" name="Liga" value="{{old('Liga')}}" required>
		</div>

		<div class="input-group mb-3 col-5">
			<div class="input-group-prepend">
				<span class="input-group-text">Manager</span>
			</div>
			<input type="text" class="form-control" name="Manager" value="{{old('Manager')}}" required>
		</div>

		<div class="text-center">
			<button type="submit" class="btn btn-primary">Salveaza</button>
		</div>
		@include('errors')
	</form>
</div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="Stylesheet" />
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){

    $("#cauta_tara").autocomplete({
        source: function(request, response) {
             $.ajax({
                url:"{{ route('tara.cauta') }}",
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
});
</script>

@endsection
