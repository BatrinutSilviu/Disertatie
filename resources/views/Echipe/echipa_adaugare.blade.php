@extends('layouts.app-navbar')

@section('content')	

	<h1>Adaugare</h1>
	<form method="POST" action="/echipa">
		{{ csrf_field() }}

		<div class="input-group mb-3 control">
			<div class="input-group-prepend">
				<span class="input-group-text">Nume</span>
			</div>
			<input type="text" class="form-control" name="Nume" value="{{old('Nume')}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Tara</span>
			</div>
			<input type="text" class="form-control" name="Tara" value="{{old('Tara')}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Liga</span>
			</div>
			<input type="text" class="form-control" name="Liga" value="{{old('Liga')}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Manager</span>
			</div>
			<input type="text" class="form-control" name="Manager" value="{{old('Manager')}}" required>
		</div>

		<div class="text-center">
			<button type="submit" class="btn btn-primary">Adaugare</button>
		</div>
		@include('errors')
	</form>

@endsection
