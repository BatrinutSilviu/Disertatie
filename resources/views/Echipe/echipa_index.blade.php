@extends('layouts.app-navbar')

@section('content') 
	<table class="table table-striped table-bordered">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Tara</th>
                <th>Liga</th>
                <th>Manager</th>
                @if( auth()->check() )
                    <th>Actiuni</th>
                @endif
                
            </tr>
        </thead>
        <tbody>
            @foreach ($echipe as $echipa)
                <tr>
                    <td>
                        <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Lot"
                            href ="/echipa/{{$echipa->id}}/jucatori">{{ $echipa->Nume }}</a>
                    </td>
                    <td><img width="20px" class="img-circle" src="images/{{$echipa->Tara}}.png"></td>
                    <td>{{ $echipa->Liga }}</td>
                    <td>{{ $echipa->Manager }}</td>
                    @if( auth()->check() )
                        <td>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica echipa"
                                href ="/echipa/{{$echipa->id}}/modificare">
                                <span class="material-icons">create</span>
                            </a>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Sterge echipa"
                                href ="/echipa/{{$echipa->id}}/stergere" onclick="return confirm('Sunteti sigur ca doriti stergerea?')">
                                <span class="material-icons">remove_circle_outline</span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
  	</table>
@if( auth()->check() )
  	<a class="btn btn-primary" href ="/echipa/adaugare">Adaugare</a>
@endif

@endsection
