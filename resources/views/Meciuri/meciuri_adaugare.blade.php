@extends('layouts.app-navbar')

@section('content')
<div class="custom_container custom_panel">	
	<h1 class="titlu text-center">
		<span class="material-icons edit-icon">sports_soccer</span>
		Adaugare meci
		<span class="material-icons edit-icon">sports_soccer</span>
	</h1>
	<div class="row">
		<form method="POST" action="/meci" class="w-100">
			{{ csrf_field() }}
			<input name="toggler" id="toggler" type="checkbox" data-toggle="toggle" data-onstyle="toggle-cluburi" data-offstyle="toggle-nationale" data-on="Cluburi" data-off="Nationale" checked>
			<div class="row m-0">
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Competitie</span>
					</div>
					<input type="text" name="competitie_id" id="cauta_competitie" class="form-control" placeholder="Cauta competitie" value="{{old('competitie_id')}}" required/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Teren</span>
					</div>
					<input type="text" name="teren" class="form-control" value="{{old('teren')}}">
				</div>
				<a class="btn display_hidden" type="button" style="color:transparent">
					<span class="material-icons">add_circle_outline</span>
				</a>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Data</span>
					</div>
					<input type="datetime-local" id="data" name="data" max="3000-12-31" min="1000-01-01" class="form-control" value="{{old('data')}}" required>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Arbitru</span>
					</div>
					<input type="text" name="arbitru" class="form-control" value="{{old('arbitru')}}">
				</div>
				<a class="btn display_hidden" type="button" style="color:transparent">
					<span class="material-icons">add_circle_outline</span>
				</a>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Echipa gazda</span>
					</div>
					<input type="text" class="form-control" id="cauta_echipa_gazda" name="echipa_gazda_id" placeholder="Cauta echipa" value="{{old('echipa_gazda_id')}}" required>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Echipa oaspete</span>
					</div>
					<input type="text" class="form-control" id="cauta_echipa_oaspete" name="echipa_oaspete_id" placeholder="Cauta echipa" value="{{old('echipa_oaspete_id')}}" required>
				</div>
				<a class="btn display_hidden" type="button" style="color:transparent">
					<span class="material-icons">add_circle_outline</span>
				</a>
				<div class="input-group mb-3 col-5 col-4 meciuriTrecute">
					<div class="input-group-prepend">
						<span class="input-group-text">Goluri gazda</span>
					</div>
					<input id="goluri_gazde" min="0" type="number" class="form-control" name="goluri_gazde" value="{{old('goluri_gazde')}}">
				</div>
				<a id="adauga_marcatori_gazda" class="btn meciuriTrecute" type="button" data-toggle="tooltip" data-placement="top" title="Adauga marcatori">
					<span class="material-icons">add_circle_outline</span>
				</a>
				<div class="input-group mb-3 col-5 col-4 ml-auto meciuriTrecute">
					<div class="input-group-prepend">
						<span class="input-group-text">Goluri oaspeti</span>
					</div>
					<input id="goluri_oaspeti" min="0" type="number" class="form-control" name="goluri_oaspeti" value="{{old('goluri_oaspeti')}}">
				</div>
				<a id="adauga_marcatori_oaspeti" class="btn meciuriTrecute" type="button" data-toggle="tooltip" data-placement="top" title="Adauga marcatori">
					<span class="material-icons">add_circle_outline</span>
				</a>
			</div>
			<div class="row">
				<div id="campuri_marcatori_gazda" class="col-6"></div>
				<div id="campuri_marcatori_oaspeti" class="col-6"></div>
			</div>
			<div class="row m-0">
				<div class="input-group mb-3 col-5 col-4 meciuriTrecute">
					<div class="input-group-prepend">
						<span class="input-group-text">Cartonase gazda</span>
					</div>
					<input id="cartonase_gazde" min="0" type="number" class="form-control" name="cartonase_gazde" value="{{old('cartonase_gazde')}}">
				</div>
				<a id="adauga_cartonase_gazda" class="btn meciuriTrecute" type="button" data-toggle="tooltip" data-placement="top" title="Adauga cartonase">
					<span class="material-icons">add_circle_outline</span>
				</a>
				<div class="input-group mb-3 col-5 col-4 ml-auto meciuriTrecute">
					<div class="input-group-prepend">
						<span class="input-group-text">Cartonase oaspeti</span>
					</div>
					<input id="cartonase_oaspeti" min="0" type="number" class="form-control" name="cartonase_oaspeti" value="{{old('cartonase_oaspeti')}}">
				</div>
				<a id="adauga_cartonase_oaspeti" class="btn meciuriTrecute" type="button" data-toggle="tooltip" data-placement="top" title="Adauga cartonase">
					<span class="material-icons">add_circle_outline</span>
				</a>
			</div>
			<div class="row">
				<div id="campuri_cartonase_gazda" class="col-6"></div>
				<div id="campuri_cartonase_oaspeti" class="col-6"></div>
			</div>

			<div class="text-center mt-4">
				<button class="btn btn-primary" type="submit">Salveaza</button>
			</div>
			@include('errors')
			@if (Session::has( 'warning' ))
			<div class="alert alert-danger alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>{{ Session::get( 'warning' ) }}</strong>
			</div>
			@endif
		</form>
	</div>
</div>

<link href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="Stylesheet" />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>

	function cautaCluburi() {
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
	}

	function cautaNationale() {
		$("#cauta_echipa_gazda").autocomplete({
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
		$("#cauta_echipa_oaspete").autocomplete({
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
		$('.meciuriTrecute').css("display","none");
		$('#toggler').on('change', function() {
			if (this.checked) {
				cautaCluburi();
			} else {
				cautaNationale();
			}
		});
		$('#data').on('change', function() {
			var data = $('#data').val();
			var today = new Date();
			if (data < today.toISOString()) 
			{
				$('.meciuriTrecute').css("display","flex");
			}
			else
			{
				$('.meciuriTrecute').css("display","none");
			}
		});
		cautaCluburi();

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
			$('#campuri_marcatori_gazda').append('<div class="row row-gazde pl-3 pr-3">'+
				'<div class="input-group col-7 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori">Marcator</label>'+
				'</div>'+
				'<input type="text" name="marcator_gazda[]" class="form-control cautaJucator" placeholder="Nume marcator"/>'+
				'</div>'+
				'<div class="input-group col-5 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori">Minut</label>'+
				'</div>'+
				'<input type="number" name="minut_gazda[]" class="form-control"/>'+
				'</div>'+
				'<div class="input-group col-6 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori" for="selectPicior">Picior</label>'+
				'</div>'+
				'<select class="custom-select" id="selectPicior" name="picior_gazda[]">'+
				'<option value="dreptul">Dreptul</option>'+
				'<option value="stangul">Stangul</option>'+
				'<option value="capul">Capul</option>'+
				'<option value="capul">Altfel</option>'+
				'</select>'+
				'</div>'+
				'<div class="input-group col-6 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori" for="selectPenalty">Penalty</label>'+
				'</div>'+
				'<select class="custom-select" id="selectPenalty" name="penalty_gazda[]">'+
				'<option value="0">Nu</option>'+
				'<option value="1">Da</option>'+
				'</select>'+
				'</div>'+
				'<div class="input-group col-7 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori">Assister</label>'+
				'</div>'+
				'<input type="text" name="assist_gazda[]" class="form-control cautaJucator" placeholder="Nume assister"/>'+
				'</div>'+
				'<a class="btn ml-auto" type="button" data-toggle="tooltip" data-placement="top" title="Elimina marcatori">'+
				'<span class="material-icons">remove_circle_outline</span>'+
				'</a>'+
				'</div>');
			$('#campuri_marcatori_gazda').find('input.cautaJucator').autocomplete({
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
		$("#campuri_marcatori_gazda").on("click", "a", function(){
			$(this).closest("div.row").remove();
		});
		$('#adauga_marcatori_oaspeti').click(function(){
			$('#campuri_marcatori_oaspeti').append(
				'<div class="row row-oaspeti pl-3 pr-3">'+
				'<div class="input-group col-7 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori">Marcator</label>'+
				'</div>'+
				'<input type="text" name="marcator_oaspete[]" class="form-control cautaJucator" placeholder="Nume marcator"/>'+
				'</div>'+
				'<div class="input-group col-5 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori">Minut</label>'+
				'</div>'+
				'<input type="number" name="minut_oaspete[]" class="form-control"/>'+
				'</div>'+
				'<div class="input-group col-6 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori" for="selectPicior">Picior</label>'+
				'</div>'+
				'<select class="custom-select" id="selectPicior" name="picior_oaspete[]">'+
				'<option value="dreptul">Dreptul</option>'+
				'<option value="stangul">Stangul</option>'+
				'<option value="capul">Capul</option>'+
				'<option value="capul">Altfel</option>'+
				'</select>'+
				'</div>'+
				'<div class="input-group col-6 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori" for="selectPenalty">Penalty</label>'+
				'</div>'+
				'<select class="custom-select" id="selectPenalty" name="penalty_oaspete[]">'+
				'<option value="0">Nu</option>'+
				'<option value="1">Da</option>'+
				'</select>'+
				'</div>'+
				'<div class="input-group col-7 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori">Assister</label>'+
				'</div>'+
				'<input type="text" name="assist_oaspete[]" class="form-control cautaJucator" placeholder="Nume assister"/>'+
				'</div>'+
				'<a class="btn ml-auto" type="button" data-toggle="tooltip" data-placement="top" title="Elimina marcatori">'+
				'<span class="material-icons">remove_circle_outline</span>'+
				'</a>'+
				'</div>');
			$('#campuri_marcatori_oaspeti').find('input.cautaJucator').autocomplete({
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
		$("#campuri_marcatori_oaspeti").on("click", "a", function(){
			$(this).closest("div.row").remove();
		});

		$('#adauga_cartonase_gazda').click(function(){
			$('#campuri_cartonase_gazda').append(
				'<div class="row row-gazde pl-3 pr-3">'+
				'<div class="input-group col-7 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori">Jucator</label>'+
				'</div>'+
				'<input id="cauta_cartonas_gazda" type="text" name="cartonas_gazda[]" class="form-control cautaJucator" placeholder="Nume jucator"/>'+
				'</div>'+
				'<div class="input-group col-5 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori">Minut</label>'+
				'</div>'+
				'<input type="number" name="cart_minut_gazde[]" class="form-control"/>'+
				'</div>'+
				'<div class="input-group mb-3 col-7">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori" for="selectCuloare">Culoare</label>'+
				'</div>'+
				'<select class="custom-select" id="selectCuloare" name="culoare_gazde" >'+
				'<option value="none">Alege</option>'+
				'<option value="1">Galben</option>'+
				'<option value="0">Rosu</option>'+
				'</select>'+
				'</div>'+
				'<a class="btn ml-auto" type="button" data-toggle="tooltip" data-placement="top" title="Elimina cartonas">'+
				'<span class="material-icons">remove_circle_outline</span>'+
				'</a>'+
				'</div>');
			$('#campuri_cartonase_gazda').find('input.cautaJucator').autocomplete({
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
		$("#campuri_cartonase_gazda").on("click", "a", function(){
			$(this).closest("div.row").remove();
		});
		$('#adauga_cartonase_oaspeti').click(function(){
			$('#campuri_cartonase_oaspeti').append(
				'<div class="row row-oaspeti pl-3 pr-3">'+
				'<div class="input-group col-7 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori">Jucator</label>'+
				'</div>'+
				'<input id="cauta_cartonas_oaspete" type="text" name="cartonas_oaspete[]" class="form-control cautaJucator" placeholder="Nume jucator"/>'+
				'</div>'+
				'<div class="input-group col-5 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori">Minut</label>'+
				'</div>'+
				'<input type="number" name="cart_minut_oaspete[]" class="form-control"/>'+
				'</div>'+
				'<div class="input-group mb-3 col-7">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori" for="selectCuloare">Culoare</label>'+
				'</div>'+
				'<select class="custom-select" id="selectCuloare" name="culoare_oaspete" >'+
				'<option value="none">Alege</option>'+
				'<option value="1">Galben</option>'+
				'<option value="0">Rosu</option>'+
				'</select>'+
				'</div>'+
				'<a class="btn ml-auto" type="button" data-toggle="tooltip" data-placement="top" title="Elimina cartonas">'+
				'<span class="material-icons">remove_circle_outline</span>'+
				'</a>'+
				'</div>');
			$('#campuri_cartonase_oaspeti').find('input.cautaJucator').autocomplete({
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
		$("#campuri_cartonase_oaspeti").on("click", "a", function(){
			$(this).closest("div.row").remove();
		});
	});

</script>

@endsection
