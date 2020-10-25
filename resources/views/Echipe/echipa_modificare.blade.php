@extends('layouts.app-navbar')

@section('content')

	<h1>Modificare echipa</h1>
	<form method="POST" action="/echipa/{{$echipa->id}}">
		{{ method_field('PATCH') }}
		{{ csrf_field() }}

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Nume</span>
			</div>
			<input type="text" class="form-control" name="Nume" value="{{$echipa->nume}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Tara</span>
			</div>
			<input id ="cauta_tara" type="text" class="form-control" name="Tara" value="{{$echipa->tara->nume}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Liga</span>
			</div>
			<input type="text" class="form-control" name="Liga" value="{{$echipa->liga}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Manager</span>
			</div>
			<input type="text" class="form-control" name="Manager" value="{{$echipa->manager}}" required>
		</div>

		<div class="field">
			<div class="control">
				<button type="submit" class="btn btn-primary">Modifica</button>
			</div>
		</div>
		@include('errors')
	</form>

	<form method="GET" action="/echipa/{{$echipa->id}}/stergere">
			@method('DELETE')
			@csrf
			<div class="field">
				<div class="control">
					<button type="submit" class="btn btn-danger" onclick="return confirm('Sunteti sigur ca doriti stergerea?')">Sterge</button>
				</div>
			</div>
	</form>

	<form method="POST" action="/echipa">
			@method('GET')
			@csrf
			<div class="field">
				<div class="control">
					<button type="submit" class="btn btn-secondary">Renuntare</button>
				</div>
			</div>
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