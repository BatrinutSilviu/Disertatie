@extends('layouts.app-navbar')

@section('content')
<div class="container">	
	<h1 align="center" class="titlu">Modifica nationala</h1>
	<form method="POST" action="/nationala/{{$nationala->id}}">
		{{ method_field('PATCH') }}
		{{ csrf_field() }}
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Nume</span>
			</div>
			<input type="text" class="form-control" name="Nume" value="{{$nationala->tara->nume}}" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Afiliere</span>
			</div>
			<input type="text" class="form-control" name="Afiliere" value="{{$nationala->afiliere}}" required>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Selectioner</span>
			</div>
			<input type="text" class="form-control" name="Selectioner" value="{{$nationala->selectioner}}" required>
		</div>

		<div class="field text-right">
			<div class="control">
				<a type="button" class="btn btn-secondary" href="{{ route('nationala.index') }}">Renuntare</a>
				<button type="submit" class="btn btn-primary">Modifica</button>
			</div>
		</div>
		@include('errors')
	</form>

	<!-- <form method="GET" action="/nationala/{{$nationala->id}}/stergere">
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
					<button type="submit" class="btn btn-secondary">Renuntare</button>
				</div>
			</div>
	</form> -->
</div>
@endsection