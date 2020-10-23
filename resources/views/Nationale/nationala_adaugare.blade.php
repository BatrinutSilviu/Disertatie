@extends('layouts.app-navbar')

@section('content')	

	<h1>Adaugare</h1>
	<form method="POST" action="/nationala">
		{{ csrf_field() }}

		<div class="input-group mb-3 control">
			<div class="input-group-prepend">
				<span class="input-group-text">Nume</span>
			</div>
			<input id="cauta_tara" type="text" class="form-control" name="Nume" value="{{old('Nume')}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Afiliere</span>
			</div>
			<input type="text" class="form-control" name="Afiliere" value="{{old('Afiliere')}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Selectioner</span>
			</div>
			<input type="text" class="form-control" name="Selectioner" value="{{old('Selectioner')}}" required>
		</div>

		<div class="text-center">
			<button type="submit" class="btn btn-primary">Adaugare</button>
		</div>
		@include('errors')
	</form>

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
