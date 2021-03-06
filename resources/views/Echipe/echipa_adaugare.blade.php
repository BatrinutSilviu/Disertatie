@extends('layouts.app-navbar')

@section('content')	
<div class="custom_container custom_panel">	
	<h1 class="titlu text-center" style="margin-bottom: 5%">
		<span class="material-icons edit-icon">emoji_events</span>
		Adaugare echipa
		<span class="material-icons edit-icon">emoji_events</span>
	</h1>
	<form method="POST" action="/echipa" style="margin-left: 28%" class="w-100">
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
				<span class="input-group-text">Manager</span>
			</div>
			<input type="text" class="form-control" name="Manager" value="{{old('Manager')}}" required>
		</div>
		
		<div class="d-flex">
			<div class="input-group mb-3 col-5 col-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Numar competitii</span>
				</div>
				<input min="0" type="number" class="form-control" name="numar_competitii" value="{{old('numar_competitii')}}" required>
			</div>
			<a id="adauga_competitii" class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Adauga competitie">
				<span class="material-icons">add_circle_outline</span>
			</a>
		</div>

		<div class="row">
			<div id="campuri_competitii" class="col-6"></div>
		</div>
		@include('errors')
		@if (Session::has( 'warning' ))
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{{ Session::get( 'warning' ) }}</strong>
		</div>
		@endif
		<div class="mt-4" style="margin-left: 15%;">
			<button type="submit" class="btn btn-primary">Salveaza</button>
		</div>
	</form>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="Stylesheet" />
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$(document).ready(function(){

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

		$('#adauga_competitii').click(function(){
			$('#campuri_competitii').append(
				'<div class="row row-gazde pl-3 pr-3">'+
				'<div class="input-group col-10 mb-3">'+
				'<div class="input-group-prepend">'+
				'<label class="input-group-text input-group-text-marcatori">Competitie</label>'+
				'</div>'+
				'<input id="cauta_competitie" type="text" name="competitii[]" class="form-control cauta_competitie" placeholder="Nume competitie"/>'+
				'</div>'+
				'<a class="btn ml-auto" type="button" data-toggle="tooltip" data-placement="top" title="Elimina competitii">'+
				'<span class="material-icons">remove_circle_outline</span>'+
				'</a>'+
				'</div>');
			$('#campuri_competitii').find('input.cautaCompetitie').autocomplete({
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
		$("#campuri_competitii").on("click", "a", function(){
			$(this).closest("div.row").remove();
		});
	});
</script>

@endsection
