@extends('layouts.app-navbar')

@section('content')

	<h1>Editare jucator</h1>
	<form method="POST" action="/jucator/{{$jucator->id}}">
		{{ method_field('PATCH') }}
		{{ csrf_field() }}


		<div class="field">
			<label class="label" for="Nume">Nume</label>

			<div class="control">
				<input type = "text" class="input" name="Nume" placeholder="Nume" value="{{$jucator->Nume}}" required>
			</div>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Data nasterii</span>
			</div>
			<input type="date" name="Data_nasterii" max="3000-12-31" min="1000-01-01" class="form-control" value="1995-06-15" required>
		</div>

		<div class="field">
		<label class="label" for="Inaltime">Inaltime</label>
		<div class="control">
			<input type = "text" class="input" name="Inaltime" placeholder="Inaltime" value="{{$jucator->Inaltime}}">
		</div>
		</div>

		<div class="field">
		<label class="label" for="Picior_preferat">Picior preferat</label>
		<div class="control">
			<input type = "text" class="input" name="Picior_preferat" placeholder="Picior preferat" value="{{$jucator->Picior_preferat}}">
		</div>
		</div>

		<div class="field">
		<label class="label" for="Post">Post</label>
		<div class="control">
			<input type = "text" class="input" name="Post" placeholder="Post" value="{{$jucator->Post}}">
		</div>
		</div>

		<div class="field">
			<label class="label" for="Nationalitate">Nationalitate</label>

			<div class="control">
				<input type = "text" class="input" name="Nationalitate" placeholder="Nationalitate" value="{{$jucator->Nationalitate}}" required>
			</div>
		</div>
@if(!empty($jucator->Echipa->Nume))
		<div class="field">
			<label class="label" for="Echipa">Echipa</label>

			<div class="control">
				<input type = "text" class="input" name="Echipa" placeholder="Echipa" value="{{$jucator->Echipa->Nume}}">
			</div>
		</div>
		@else
		<div class="field">
			<label class="label" for="Echipa">Echipa</label>

			<div class="control">
				<input type = "text" class="input" name="Echipa" placeholder="Fara Echipa">
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
					<button type="submit" class="btn btn-danger" onclick="return confirm('Sure Want Delete?')">Sterge</button>
				</div>
			</div>
	</form>

@endsection