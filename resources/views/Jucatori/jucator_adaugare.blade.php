@extends('layouts.app-navbar')

@section('content')	
	<h1>Adaugare</h1>
	<form method="POST" action="/jucator">
		{{ csrf_field() }}
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Nume</span>
			</div>
			<input type="text" class="form-control" name="Nume" value="{{old('Nume')}}" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Data nasterii</span>
			</div>
			<input type="date" name="Data_nasterii" max="3000-12-31" min="1000-01-01" class="form-control" value="1995-06-15" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Inaltime</span>
			</div>
			<input type="number" class="form-control" name="Inaltime" value="{{old('Inaltime')}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="selectPicior">Picior preferat</label>
			</div>
			<select class="custom-select" id="selectPicior" name="Picior_preferat">
				<option value="none">Alege</option>
				<option value="dreptul">Dreptul</option>
				<option value="stangul">Stangul</option>
				<option value="ambele">Ambele</option>
			</select>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="selectPost">Post</label>
			</div>
			<select class="custom-select" id="selectPost" name="Post">
				<option value="none">Alege</option>
				<option value="portar">Portar</option>
				<option value="fundas">Fundas</option>
				<option value="mijlocas">Mijlocas</option>
				<option value="atacant">Atacant</option>
			</select>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Echipa</span>
			</div>
			<input type="number" class="form-control" name="echipa_id" value="{{old('echipa_id')}}" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Echipa nationala</span>
			</div>
			<input type="number" class="form-control" name="nationala_id" value="{{old('nationala_id')}}" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Nationalitate</span>
			</div>
			<input type="text" class="form-control" name="Nationalitate" value="{{old('Nationalitate')}}" required>
		</div>

		<div class="text-center">
			<button class="btn btn-primary" type="submit">Adaugare</button>
		</div>
		@include('errors')
	</form>

@endsection
