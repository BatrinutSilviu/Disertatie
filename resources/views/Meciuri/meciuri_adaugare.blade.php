@extends('layouts.app-navbar')

@section('content')	
	<h1>Adaugare</h1>
	<form method="POST" action="/meci">
		{{ csrf_field() }}
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Echipa gazda</span>
			</div>
			<input type="text" class="form-control" id="cauta_echipa_gazda" name="echipa_gazda_id" placeholder="Cauta echipa" value="{{old('echipa_gazda_id')}}" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Echipa oaspete</span>
			</div>
			<input type="text" class="form-control" id="cauta_echipa_oaspete" name="echipa_oaspete_id" placeholder="Cauta echipa" value="{{old('echipa_oaspete_id')}}" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Data</span>
			</div>
			<input type="date" name="data" max="3000-12-31" min="1000-01-01" class="form-control" value="{{old('data')}}" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Goluri gazda</span>
			</div>
			<input type="number" class="form-control" name="goluri_gazde" value="{{old('goluri_gazde')}}" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Goluri oaspeti</span>
			</div>
			<input type="number" class="form-control" name="goluri_oaspeti" value="{{old('goluri_oaspeti')}}" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Competitie</span>
			</div>
			<input type="text" name="competitie_id" id="cauta_competitie" class="form-control" placeholder="Cauta competitie" value="{{old('competitie_id')}}" required/>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Teren</span>
			</div>
			<input type="text" name="teren" class="form-control" value="{{old('teren')}}">
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Arbitru</span>
			</div>
			<input type="text" name="arbitru" class="form-control" value="{{old('arbitru')}}">
		</div>

		<div class="text-center">
			<button class="btn btn-primary" type="submit">Adaugare</button>
		</div>
		@include('errors')
	</form>

    
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="Stylesheet" />
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){

	$("#cauta_echipa_gazda").autocomplete({
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
	$("#cauta_echipa_oaspete").autocomplete({
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
	$("#cauta_competitie").autocomplete({
		source: function(request, response) {
			 $.ajax({
				url:"{{ route('competitie.cauta') }}",
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
