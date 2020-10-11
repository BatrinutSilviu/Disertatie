@extends('layouts.app-navbar')

@section('content')

	<h1>Modificare echipa</h1>
	<form method="POST" action="/echipa/{{$echipa->id}}">
		{{ method_field('PATCH') }}
		{{ csrf_field() }}

		<div class="field">
			<label class="label" for="Nume">Nume</label>

			<div class="control">
				<input type = "text" class="input" name="Nume" placeholder="Nume" value="{{$echipa->Nume}}" required>
			</div>
		</div>

		<div class="field">
			<label class="label" for="Tara">Tara</label>

			<div class="control">
				<input type = "text" class="input" name="Tara" placeholder="Tara" value="{{$echipa->Tara}}" required>
			</div>
		</div>

		<div class="field">
			<label class="label" for="Liga">Liga</label>

			<div class="control">
				<input type = "text" class="input" name="Liga" placeholder="Liga" value="{{$echipa->Liga}}" required>
			</div>
		</div>

		<div class="field">
			<label class="label" for="Manager">Manager</label>

			<div class="control">
				<input type = "text" class="input" name="Manager" placeholder="Manager" value="{{$echipa->Manager}}" required>
			</div>
		</div>

		<div class="field">
			<div class="control">
				<button type="submit" class="button is-link">Modifica</button>
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
					<button type="submit" class="button is-link">Renuntare</button>
				</div>
			</div>
	</form>

@endsection