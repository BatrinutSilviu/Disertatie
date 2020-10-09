@extends('layouts.app-navbar')

@section('content')	

	<h1>Adaugare</h1>
	<form method="POST" action="/nationala">
		{{ csrf_field() }}

		<div class="input-group mb-3 control">
			<div class="input-group-prepend">
				<span class="input-group-text">Nume</span>
			</div>
			<input type="text" class="form-control" name="Nume" value="{{old('Nume')}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Prescurtare</span>
			</div>
			<input type="text" class="form-control" name="Prescurtare" value="{{old('Prescurtare')}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Afiliere</span>
			</div>
			<input type="text" class="form-control" name="Afiliere" value="{{old('Afiliere')}}" required>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Selectioner</span>
			</div>
			<input type="text" class="form-control" name="Selectioner" value="{{old('Selectioner')}}" required>
		</div>

		<div class="text-center">
			<button type="submit" class="btn btn-primary">Adaugare</button>
		</div>
		@include('errors')
	</form>

@endsection
