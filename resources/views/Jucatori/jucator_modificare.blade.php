@extends('layouts.app-navbar')

@section('content')
<div class="custom_container custom_panel">	
	<h1 class="titlu text-center" style="margin-bottom: 5%">
		<span class="material-icons edit-icon">directions_run</span>
		Editeaza jucator
		<span class="material-icons edit-icon">directions_run</span>
	</h1>
	<div class="row">
		<form method="POST" action="/jucator/{{$jucator->id}}" class="w-100">
			{{ method_field('PATCH') }}
			{{ csrf_field() }}

			<div class="row">
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Nume</span>
					</div>
					<input type="text" class="form-control" name="Nume" value="{{$jucator->nume}}" required>
				</div>

				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Data nasterii</span>
					</div>
					<input type="date" name="Data_nasterii" max="3000-12-31" min="1000-01-01" class="form-control" value="{{old('data_nasterii',$jucator->data_nasterii)}}" required>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Inaltime</span>
					</div>
					<input type="number" class="form-control" name="Inaltime" value="{{$jucator->inaltime}}" required>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
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
				<div class="input-group mb-3 col-5">
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
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Nationalitate</span>
					</div>
					<input type="text" name="Nationalitate" id="cauta_tara" class="form-control" placeholder="Cauta tara" value="{{App\Tara::where('prescurtare','=',$jucator->nationalitate)->value('nume')}}" required>
				</div>

				@if(!empty($jucator->Echipa->nume))
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Echipa</span>
					</div>
					<input type="text" name="echipa_id" id="cauta_echipa" class="form-control" placeholder="Cauta echipa" value="{{$jucator->Echipa->nume}}" />
				</div>
				@else
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Echipa</span>
					</div>
					<input type="text" name="echipa_id" id="cauta_echipa" class="form-control" placeholder="Fara echipa" />
				</div>
				@endif	

				@if(!empty($jucator->Nationala->nume))
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Echipa nationala</span>
					</div>
					<input type="text" name="nationala_id" id="cauta_nationala" class="form-control" placeholder="Cauta echipa" value="{{$jucator->Nationala->nume}}"/>
				</div>
				@else
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Echipa nationala</span>
					</div>
					<input type="text" name="nationala_id" id="cauta_nationala" class="form-control" placeholder="Fara Nationala"/>
				</div>
				@endif

				@if( $jucator->post == "portar")
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Parade</span>
					</div>
					<input type="number" name="parade" class="form-control" value="{{$jucator->parade}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Iesiri din poarta</span>
					</div>
					<input type="number" name="iesiri_din_poarta" class="form-control" value="{{$jucator->iesiri_din_poarta}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Boxari</span>
					</div>
					<input type="number" name="boxari" class="form-control" value="{{$jucator->boxari}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Plonjari</span>
					</div>
					<input type="number" name="plonjari" class="form-control" value="{{$jucator->plonjari}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Goluri primite</span>
					</div>
					<input type="number" name="goluri_primite" class="form-control" value="{{$jucator->goluri_primite}}"/>
				</div>
				@else
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Pase</span>
					</div>
					<input type="number" name="pase" class="form-control" value="{{$jucator->pase}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Pase cheie</span>
					</div>
					<input type="number" name="pase_cheie" class="form-control" value="{{$jucator->pase_cheie}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Precizie pase</span>
					</div>
					<input type="number" name="precizie_pase" class="form-control" value="{{$jucator->precizie_pase}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Sanse create</span>
					</div>
					<input type="number" name="sanse_create" class="form-control" value="{{$jucator->sanse_create}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Goluri primite</span>
					</div>
					<input type="number" name="goluri_primite" class="form-control" value="{{$jucator->goluri_primite}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Suturi</span>
					</div>
					<input type="number" name="suturi" class="form-control" value="{{$jucator->suturi}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Suturi blocate</span>
					</div>
					<input type="number" name="suturi_blocate" class="form-control" value="{{$jucator->suturi_blocate}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Precizie suturi</span>
					</div>
					<input type="number" name="precizie_suturi" class="form-control" value="{{$jucator->precizie_suturi}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Centrari</span>
					</div>
					<input type="number" name="centrari" class="form-control" value="{{$jucator->centrari}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Dueluri aeriene castigate</span>
					</div>
					<input type="number" name="dueluri_aeriene_castigate" class="form-control" value="{{$jucator->dueluri_aeriene_castigate}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Dueluri aeriene pierdute</span>
					</div>
					<input type="number" name="dueluri_aeriene_pierdute" class="form-control" value="{{$jucator->dueluri_aeriene_pierdute}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Degajari</span>
					</div>
					<input type="number" name="degajari" class="form-control" value="{{$jucator->degajari}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Mingi profunzime</span>
					</div>
					<input type="number" name="mingi_profunzime" class="form-control" value="{{$jucator->mingi_profunzime}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Deposedat</span>
					</div>
					<input type="number" name="deposedat" class="form-control" value="{{$jucator->deposedat}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Driblinguri incercate</span>
					</div>
					<input type="number" name="driblinguri_incercate" class="form-control" value="{{$jucator->driblinguri_incercate}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Driblinguri reusite</span>
					</div>
					<input type="number" name="driblinguri_reusite" class="form-control" value="{{$jucator->driblinguri_reusite}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Dueluri pierdute</span>
					</div>
					<input type="number" name="dueluri_pierdute" class="form-control" value="{{$jucator->dueluri_pierdute}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Dueluri castigate</span>
					</div>
					<input type="number" name="dueluri_castigate" class="form-control" value="{{$jucator->dueluri_castigate}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Faulturi</span>
					</div>
					<input type="number" name="faulturi" class="form-control" value="{{$jucator->faulturi}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Interceptii</span>
					</div>
					<input type="number" name="interceptii" class="form-control" value="{{$jucator->interceptii}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Recuperari</span>
					</div>
					<input type="number" name="recuperari" class="form-control" value="{{$jucator->recuperari}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Faultat</span>
					</div>
					<input type="number" name="faultat" class="form-control" value="{{$jucator->faultat}}"/>
				</div>
				<div class="input-group mb-3 col-5">
					<div class="input-group-prepend">
						<span class="input-group-text">Deposedari incercate</span>
					</div>
					<input type="number" name="deposedari_incercate" class="form-control" value="{{$jucator->deposedari_incercate}}"/>
				</div>
				<div class="input-group mb-3 col-5 ml-auto">
					<div class="input-group-prepend">
						<span class="input-group-text">Deposedari reusite</span>
					</div>
					<input type="number" name="deposedari_reusite" class="form-control" value="{{$jucator->deposedari_reusite}}"/>
				</div>
				@endif
			</div>
			<div align="center">
				<div class="control mt-4">
					<a type="button" class="btn btn-secondary" href="{{ route('jucator.index') }}">Renunta</a>
					<button type="submit" class="btn btn-primary">Modifica</button>
				</div>
			</div>
			@include('errors')
		</form>
	</div>

<!-- 	<form method="POST" action="/jucator/{{$jucator->id}}">
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
		</form> -->
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