@extends('layouts.app-navbar')

@section('content')

@if( auth()->check() )
	@if( auth()->id() !== 1 )
	<div id="rezultat" >
	<p>Ultimul rezultat</p>
	</div>
	<div id="program">
	<p>Meciul urmator</p>
	</div>
	<div id="clasament">
	<p>Clasament</p>
	</div>
	<div id="statut">
	<p>Statut lot</p>
	</div>

	@else

	<table class="table table-striped">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Email</th>
                <th>Echipa</th>
            </tr>
        </thead>
        <tbody>
        	@php
        		$utilizatori = App\User::all();
				foreach ( $utilizatori as $utilizator )
				{
        	@endphp
                <tr>
                    <td>
    	        	{{ $utilizator->name }}
                    </td>
                    <td>
					{{ $utilizator->email }}
                    </td>
					@php
						$echipa = App\Echipa::where('user_id','=',$utilizator->id)->value('nume');
					@endphp
                    <td>
                    	{{ $echipa }}
                	</td>
                </tr>
            @php
        	}
        	@endphp
        </tbody>
    </table>
    @endif
@else
	<h1>Se pare ca nu ai cont la noi. Daca doresti sa iti gestionezi propria echipa de fotbal, atunci inregistreaza-te chiar acum</h1>
	<a class="btn btn-primary" href ="/register">Inregistrare</a>
@endif

@endsection