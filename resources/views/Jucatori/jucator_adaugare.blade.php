@extends('layouts.app-navbar')

@section('content')
<div class="custom_container custom_panel">		
	<h1 class="titlu text-center" style="margin-bottom: 5%">
		<span class="material-icons edit-icon">directions_run</span>
		Adaugare jucator
		<span class="material-icons edit-icon">directions_run</span>
	</h1>
	<div class="row">
		<form method="POST" action="/jucator" class="w-100">
			{{ csrf_field() }}
			<div class="row m-0">
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Nume</span>
					</div>
					<input type="text" class="form-control" name="Nume" value="{{old('Nume')}}" required>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<label class="input-group-text" for="selectPost">Post</label>
					</div>
					<select class="custom-select" id="selectPost" name="Post" >
						<option value="none">Alege</option>
						<option value="portar" {{ old('Post') == 'portar' ? 'selected':"" }}>Portar</option>
						<option value="fundas" {{ old('Post') == 'fundas' ? 'selected':"" }}>Fundas</option>
						<option value="mijlocas" {{ old('Post') == 'mijlocas' ? 'selected':"" }}>Mijlocas</option>
						<option value="atacant" {{ old('Post') == 'atacant' ? 'selected':"" }}>Atacant</option>
					</select>
				</div>

				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Nationalitate</span>
					</div>
					<input type="text" name="Nationalitate" id="cauta_tara" class="form-control" placeholder="Cauta tara" value="{{old('Nationalitate')}}" required>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<label class="input-group-text" for="selectPicior">Picior preferat</label>
					</div>
					<select class="custom-select" id="selectPicior" name="Picior_preferat">
						<option value="none">Alege</option>
						<option value="dreptul" {{ old('Picior_preferat') == 'dreptul' ? 'selected':"" }}>Dreptul</option>
						<option value="stangul" {{ old('Picior_preferat') == 'stangul' ? 'selected':"" }}>Stangul</option>
						<option value="ambele" {{ old('Picior_preferat') == 'ambele' ? 'selected':"" }}>Ambele</option>
					</select>
				</div>

				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Data nasterii</span>
					</div>
					<input type="date" name="Data_nasterii" max="3000-12-31" min="1000-01-01" class="form-control" value="{{old('Data_nasterii',date('1995-06-15'))}}" required>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Echipa</span>
					</div>
					<input type="text" name="echipa_id" id="cauta_echipa" class="form-control" placeholder="Cauta echipa" value="{{old('echipa_id')}}" />
				</div>

				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Inaltime</span>
					</div>
					<input type="number" class="form-control" name="Inaltime" value="{{old('Inaltime')}}" required>
				</div>

				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Echipa nationala</span>
					</div>
					<input type="text" name="nationala_id" id="cauta_nationala" class="form-control" placeholder="Cauta echipa" value="{{old('nationala_id')}}"/>
				</div>
			</div>
			<div class="text-center">
				<button class="btn btn-primary mt-4" type="submit">Salveaza</button>
			</div>
			@include('errors')
		</form>
	</div>
</div>
    
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="Stylesheet" />
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){

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
	$("#cauta_nationala").autocomplete({
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
