@extends('layouts.app-navbar')

@section('content')
<div class="container">	
	<h1 class="titlu text-center">
		<span class="material-icons edit-icon">sports_soccer</span>
		Adaugare meci
		<span class="material-icons edit-icon">sports_soccer</span>
	</h1>
	<div class="row">
		<form method="POST" action="/meci" class="w-100">
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
			<div class="row">
				<div class="input-group mb-3 col-4">
					<div class="input-group-prepend">
						<span class="input-group-text">Goluri gazda</span>
					</div>
					<input id="goluri_gazde" min="0" type="number" class="form-control" name="goluri_gazde" value="{{old('goluri_gazde')}}" required>
				</div>
                <a id="adauga_marcatori_gazda" class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Adauga marcatori">
                    <span class="material-icons">add_circle_outline</span>
                </a>
				<div class="input-group mb-3 col-4 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Goluri oaspeti</span>
					</div>
					<input id="goluri_oaspeti" min="0" type="number" class="form-control" name="goluri_oaspeti" value="{{old('goluri_oaspeti')}}" required>
				</div>
	            <a id="adauga_marcatori_oaspeti" class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Adauga marcatori">
	                <span class="material-icons">add_circle_outline</span>
                </a>
			</div>
			<div class="row">
				<div id="campuri_gazda" class="col-6"></div>
				<div id="campuri_oaspeti" class="col-6"></div>
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
				<button class="btn btn-primary" type="submit">Salveaza</button>
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
    $('#adauga_marcatori_gazda').click(function(){
    	var inregistrari_existente_gazde = $(".row-gazde").length;
		$('#campuri_gazda').append('<div class="row row-gazde pl-3 pr-3">'+
			'<div class="input-group col-7 mb-3">'+
				'<div class="input-group-prepend">'+
					'<label class="input-group-text input-group-text-marcatori">Marcator</label>'+
				'</div>'+
				'<input id="cauta_marcator" type="text" name="marcator[]" class="form-control" placeholder="Nume marcator"/>'+
			'</div>'+
			'<div class="input-group col-4 mb-3">'+
				'<div class="input-group-prepend">'+
					'<label class="input-group-text input-group-text-marcatori">Minut</label>'+
				'</div>'+
				'<input type="number" name="minut[]" class="form-control"/>'+
			'</div>'+
			'<div class="input-group col-6 mb-3">'+
				'<div class="input-group-prepend">'+
					'<label class="input-group-text input-group-text-marcatori" for="selectPicior">Picior folosit</label>'+
				'</div>'+
				'<select class="custom-select" id="selectPicior" name="picior[]">'+
					'<option value="dreptul">Dreptul</option>'+
					'<option value="stangul">Stangul</option>'+
					'<option value="capul">Capul</option>'+
				'</select>'+
			'</div>'+
			'<div class="input-group col-5 mb-3">'+
				'<div class="input-group-prepend">'+
					'<label class="input-group-text input-group-text-marcatori" for="selectPenalty">Gol din penalty</label>'+
				'</div>'+
				'<select class="custom-select" id="selectPenalty" name="penalty[]">'+
					'<option value="0">Nu</option>'+
					'<option value="1">Da</option>'+
				'</select>'+
			'</div>'+
			'<div class="input-group col-7 mb-3">'+
				'<div class="input-group-prepend">'+
					'<label class="input-group-text input-group-text-marcatori">Assister</label>'+
				'</div>'+
				'<input id="cauta_assister" type="text" name="assist[]" class="form-control" placeholder="Nume assister"/>'+
			'</div>'+
			'<a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Elimina marcatori">'+
                '<span class="material-icons">remove_circle_outline</span>'+
            '</a>'+
		'</div>');
    });
    $("#campuri_gazda").on("click", "a", function(){
	    $(this).closest("div.row").remove();
	});
    $('#adauga_marcatori_oaspeti').click(function(){
    	var inregistrari_existente_oaspeti = $(".row-oaspeti").length;
		$('#campuri_oaspeti').append('<div class="row row-oaspeti pl-3 pr-3">'+
			'<div class="input-group col-7 mb-3">'+
				'<div class="input-group-prepend">'+
					'<label class="input-group-text input-group-text-marcatori">Marcator</label>'+
				'</div>'+
				'<input type="text" name="marcator[]" class="form-control" placeholder="Nume marcator"/>'+
			'</div>'+
			'<div class="input-group col-4 mb-3">'+
				'<div class="input-group-prepend">'+
					'<label class="input-group-text input-group-text-marcatori">Minut</label>'+
				'</div>'+
				'<input type="number" name="minut[]" class="form-control"/>'+
			'</div>'+
			'<div class="input-group col-6 mb-3">'+
				'<div class="input-group-prepend">'+
					'<label class="input-group-text input-group-text-marcatori" for="selectPicior">Picior folosit</label>'+
				'</div>'+
				'<select class="custom-select" id="selectPicior" name="picior[]">'+
					'<option value="dreptul">Dreptul</option>'+
					'<option value="stangul">Stangul</option>'+
					'<option value="capul">Capul</option>'+
				'</select>'+
			'</div>'+
			'<div class="input-group col-5 mb-3">'+
				'<div class="input-group-prepend">'+
					'<label class="input-group-text input-group-text-marcatori" for="selectPenalty">Gol din penalty</label>'+
				'</div>'+
				'<select class="custom-select" id="selectPenalty" name="penalty[]">'+
					'<option value="0">Nu</option>'+
					'<option value="1">Da</option>'+
				'</select>'+
			'</div>'+
			'<div class="input-group col-7 mb-3">'+
				'<div class="input-group-prepend">'+
					'<label class="input-group-text input-group-text-marcatori">Assister</label>'+
				'</div>'+
				'<input type="text" name="assist[]" class="form-control" placeholder="Nume assister"/>'+
			'</div>'+
			'<a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Elimina marcatori">'+
                '<span class="material-icons">remove_circle_outline</span>'+
            '</a>'+
		'</div>');
    });
    $("#campuri_oaspeti").on("click", "a", function(){
	    $(this).closest("div.row").remove();
	});
   	$("#cauta_marcator").autocomplete({
		source: function(request, response) {
			 $.ajax({
				url:"{{ route('jucator.cauta') }}",
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
	$("#cauta_assister").autocomplete({
		source: function(request, response) {
			 $.ajax({
				url:"{{ route('jucator.cauta') }}",
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
