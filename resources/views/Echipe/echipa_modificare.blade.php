@extends('layouts.app-navbar')

@section('content')

	<h1>Modificare echipa</h1>
	<form method="POST" action="/echipa/{{$echipa->id}}">
		{{ method_field('PATCH') }}
		{{ csrf_field() }}

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Nume</span>
			</div>
			<input type="text" class="form-control" name="Nume" value="{{$echipa->Nume}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Tara</span>
			</div>
			<input type="text" class="form-control" name="Tara" value="{{$echipa->Tara}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Liga</span>
			</div>
			<input type="text" class="form-control" name="Liga" value="{{$echipa->Liga}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Manager</span>
			</div>
			<input type="text" class="form-control" name="Manager" value="{{$echipa->Manager}}" required>
		</div>

		<div class="field">
			<div class="control">
				<button type="submit" class="btn btn-primary">Modifica</button>
			</div>
		</div>
		@include('errors')
	</form>

	<form method="GET" action="/echipa/{{$echipa->id}}/stergere">
			@method('DELETE')
			@csrf
			<div class="field">
				<div class="control">
					<button type="submit" class="btn btn-danger" onclick="return confirm('Sunteti sigur ca doriti stergerea?')">Sterge</button>
				</div>
			</div>
	</form>

	<form method="POST" action="/echipa">
			@method('GET')
			@csrf
			<div class="field">
				<div class="control">
					<button type="submit" class="btn btn-secondary">Renuntare</button>
				</div>
			</div>
	</form>

@endsection