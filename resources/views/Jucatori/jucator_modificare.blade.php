@extends('layouts.app-navbar')

@section('content')

	<h1>Editare jucator</h1>
	<form method="POST" action="/jucator/{{$jucator->id}}">
		{{ method_field('PATCH') }}
		{{ csrf_field() }}


<!-- 		<div class="field">
			<label class="label" for="Nume">Nume</label>

			<div class="control">
				<input type = "text" class="input" name="Nume" placeholder="Nume" value="{{$jucator->Nume}}" required>
			</div>
		</div> -->
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Nume</span>
			</div>
			<input type="text" class="form-control" name="Nume" value="{{$jucator->Nume}}" required>
		</div>

<!-- 		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Data nasterii</span>
			</div>
			<input type="date" name="Data_nasterii" max="3000-12-31" min="1000-01-01" class="form-control" value="{{$jucator->Data_nasterii}}" required>
		</div> -->
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Data nasterii</span>
			</div>
			<input type="date" name="Data_nasterii" max="3000-12-31" min="1000-01-01" class="form-control" value="{{old('Data_nasterii',date('1995-06-15'))}}" required>
		</div>

<!-- 		<div class="field">
		<label class="label" for="Inaltime">Inaltime</label>
		<div class="control">
			<input type = "text" class="input" name="Inaltime" placeholder="Inaltime" value="{{$jucator->Inaltime}}">
		</div>
		</div> -->

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Inaltime</span>
			</div>
			<input type="number" class="form-control" name="Inaltime" value="{{$jucator->Inaltime}}" required>
		</div>

<!-- 		<div class="field">
		<label class="label" for="Picior_preferat">Picior preferat</label>
		<div class="control">
			<input type = "text" class="input" name="Picior_preferat" placeholder="Picior preferat" value="{{$jucator->Picior_preferat}}">
		</div>
		</div> -->

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="selectPicior">Picior preferat</label>
			</div>
			<select class="custom-select" id="selectPicior" name="Picior_preferat" value="">
				<option value="none">Alege</option>
				<option value="dreptul" {{ $jucator->Picior_preferat == 'dreptul' ? 'selected':"" }}>Dreptul</option>
				<option value="stangul" {{ $jucator->Picior_preferat == 'stangul' ? 'selected':"" }}>Stangul</option>
				<option value="ambele" {{ $jucator->Picior_preferat == 'ambele' ? 'selected':"" }}>Ambele</option>
			</select>
		</div>

<!-- 		<div class="field">
		<label class="label" for="Post">Post</label>
		<div class="control">
			<input type = "text" class="input" name="Post" placeholder="Post" value="{{$jucator->Post}}">
		</div>
		</div> -->

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="selectPost">Post</label>
			</div>
			<select class="custom-select" id="selectPost" name="Post" >
				<option value="none">Alege</option>
				<option value="portar" {{ $jucator->Post == 'portar' ? 'selected':"" }}>Portar</option>
				<option value="fundas" {{ $jucator->Post == 'fundas' ? 'selected':"" }}>Fundas</option>
				<option value="mijlocas" {{ $jucator->Post == 'mijlocas' ? 'selected':"" }}>Mijlocas</option>
				<option value="atacant" {{ $jucator->Post == 'atacant' ? 'selected':"" }}>Atacant</option>
			</select>
		</div>

<!-- 		<div class="field">
			<label class="label" for="Nationalitate">Nationalitate</label>

			<div class="control">
				<input type = "text" class="input" name="Nationalitate" placeholder="Nationalitate" value="{{$jucator->Nationalitate}}" required>
			</div>
		</div> -->

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Nationalitate</span>
			</div>
			<input type="text" name="Nationalitate" id="cauta_tara" class="form-control" placeholder="Cauta tara" value="{{$jucator->Nationalitate}}" required>
		</div>

@if(!empty($jucator->Echipa->Nume))
<!-- 		<div class="field">
			<label class="label" for="Echipa">Echipa</label>

			<div class="control">
				<input type = "text" class="input" name="Echipa" placeholder="Echipa" value="{{$jucator->Echipa->Nume}}">
			</div>
		</div> -->
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Echipa</span>
			</div>
			<input type="text" name="Echipa" id="cauta_echipa" class="form-control" placeholder="Cauta echipa" value="{{$jucator->Echipa->Nume}}" />
		</div>
		@else
		<div class="field">
			<label class="label" for="Echipa">Echipa</label>

			<div class="control">
				<input type = "text" class="input" name="Echipa" placeholder="Fara Echipa">
			</div>
		</div>
@endif	

@if(!empty($jucator->Nationala->Nume))
<!-- 		<div class="field">
			<label class="label" for="Nationala">Nationala</label>

			<div class="control">
				<input type = "text" class="input" name="Nationala" placeholder="Nationala" value="{{$jucator->Nationala->Nume}}">
			</div>
		</div> -->
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Echipa nationala</span>
			</div>
			<input type="text" name="Nationala" id="cauta_nationala" class="form-control" placeholder="Cauta echipa" value="{{$jucator->Nationala->Nume}}"/>
		</div>
		@else
		<div class="field">
			<label class="label" for="Nationala">Nationala</label>

			<div class="control">
				<input type = "text" class="input" name="Nationala" placeholder="Fara Nationala">
			</div>
		</div>
@endif	

		<div class="field">
			<div class="control">
				<button type="submit" class="button is-link">Modifica</button>
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

@endsection