@extends('layouts.app-navbar')

@section('content')

	<h1>Editare jucator</h1>
	<form method="POST" action="/jucator/{{$jucator->id}}">
		{{ method_field('PATCH') }}
		{{ csrf_field() }}

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Nume</span>
			</div>
			<input type="text" class="form-control" name="Nume" value="{{$jucator->nume}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Data nasterii</span>
			</div>
			<input type="date" name="Data_nasterii" max="3000-12-31" min="1000-01-01" class="form-control" value="{{old('data_nasterii',date('1995-06-15'))}}" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Inaltime</span>
			</div>
			<input type="number" class="form-control" name="Inaltime" value="{{$jucator->inaltime}}" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="selectPicior">Picior preferat</label>
			</div>
			<select class="custom-select" id="selectPicior" name="Picior_preferat" value="">
				<option value="none">Alege</option>
				<option value="dreptul" {{ $jucator->picior_preferat == 'dreptul' ? 'selected':"" }}>Dreptul</option>
				<option value="stangul" {{ $jucator->picior_preferat == 'stangul' ? 'selected':"" }}>Stangul</option>
				<option value="ambele" {{ $jucator->picior_preferat == 'ambele' ? 'selected':"" }}>Ambele</option>
			</select>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="selectPost">Post</label>
			</div>
			<select class="custom-select" id="selectPost" name="Post" >
				<option value="none">Alege</option>
				<option value="portar" {{ $jucator->post == 'portar' ? 'selected':"" }}>Portar</option>
				<option value="fundas" {{ $jucator->post == 'fundas' ? 'selected':"" }}>Fundas</option>
				<option value="mijlocas" {{ $jucator->post == 'mijlocas' ? 'selected':"" }}>Mijlocas</option>
				<option value="atacant" {{ $jucator->post == 'atacant' ? 'selected':"" }}>Atacant</option>
			</select>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Nationalitate</span>
			</div>
			<input type="text" name="Nationalitate" id="cauta_tara" class="form-control" placeholder="Cauta tara" value="{{App\Tara::where('prescurtare','=',$jucator->nationalitate)->value('nume')}}" required>
		</div>

@if(!empty($jucator->Echipa->nume))
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Echipa</span>
			</div>
			<input type="text" name="echipa_id" id="cauta_echipa" class="form-control" placeholder="Cauta echipa" value="{{$jucator->Echipa->nume}}" />
		</div>
		@else
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Echipa</span>
			</div>
			<input type="text" name="echipa_id" id="cauta_echipa" class="form-control" placeholder="Fara echipa" />
		</div>
@endif	

@if(!empty($jucator->Nationala->nume))
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Echipa nationala</span>
			</div>
			<input type="text" name="nationala_id" id="cauta_nationala" class="form-control" placeholder="Cauta echipa" value="{{$jucator->Nationala->nume}}"/>
		</div>
		@else
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Echipa nationala</span>
			</div>
			<input type="text" name="nationala_id" id="cauta_nationala" class="form-control" placeholder="Fara Nationala"/>
		</div>
@endif	

		<div class="field">
			<div class="control">
				<button type="submit" class="btn btn-primary">Modifica</button>
			</div>
		</div>
@include('errors')
	</form>

	<form method="POST" action="/jucator/{{$jucator->id}}">
			@method('DELETE')
			@csrf
			<div class="field">
				<div class="control">
					<button type="submit" class="btn btn-danger" onclick="return confirm('Sunteti sigur ca doriti stergerea?')">Sterge</button>
				</div>
			</div>
	</form>

	<form method="POST" action="/jucator">
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