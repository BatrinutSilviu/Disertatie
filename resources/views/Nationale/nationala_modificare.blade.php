@extends('layouts.app-navbar')

@section('content')

	<h1>Modificare nationala</h1>
	<form method="POST" action="/nationala/{{$nationala->id}}">
		{{ method_field('PATCH') }}
		{{ csrf_field() }}

		<div class="field">
			<label class="label" for="Nume">Nume</label>

			<div class="control">
				<input type = "text" class="input" name="Nume" placeholder="Nume" value="{{$nationala->Nume}}" required>
			</div>
		</div>

		<div class="field">
			<label class="label" for="Prescurtare">Prescurtare</label>

			<div class="control">
				<input type = "text" class="input" name="Prescurtare" placeholder="Prescurtare" value="{{$nationala->Prescurtare}}" required>
			</div>
		</div>

		<div class="field">
			<label class="label" for="Afiliere">Afiliere</label>

			<div class="control">
				<input type = "text" class="input" name="Afiliere" placeholder="Afiliere" value="{{$nationala->Afiliere}}" required>
			</div>
		</div>

		<div class="field">
			<label class="label" for="Selectioner">Selectioner</label>

			<div class="control">
				<input type = "text" class="input" name="Selectioner" placeholder="Selectioner" value="{{$nationala->Selectioner}}" required>
			</div>
		</div>

		<div class="field">
			<div class="control">
				<button type="submit" class="button is-link">Modifica</button>
			</div>
		</div>
		@include('errors')
	</form>

	<form method="GET" action="/nationala/{{$nationala->id}}/stergere">
			@method('DELETE')
			@csrf
			<div class="field">
				<div class="control">
					<button type="submit" class="btn btn-danger" onclick="return confirm('Sure Want Delete?')">Sterge</button>
				</div>
			</div>
	</form>

	<form method="POST" action="/nationala">
			@method('GET')
			@csrf
			<div class="field">
				<div class="control">
					<button type="submit" class="button is-link">Renuntare</button>
				</div>
			</div>
	</form>

@endsection