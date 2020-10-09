@extends('layouts.app-navbar')

@section('content') 
	<table class="table table-striped table-bordered">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Steag</th>
                <th>Afiliere</th>
                <th>Selectioner</th>
                @if( auth()->check() )
                    <th>Actiuni</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($nationale as $nationala)
                <tr>
                    <td>
                        <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Lot"
                            href ="/nationala/{{$nationala->id}}/jucatori">{{ $nationala->Nume }}</a>
                    </td>
                    <td><img width="20px" class="img-circle" src="images/{{$nationala->Prescurtare}}.png"></td>
                    <td>{{ $nationala->Afiliere }}</td>
                    <td>{{ $nationala->Selectioner }}</td>
                    @if( auth()->check() )
                        <td>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica echipa"
                                href ="/nationala/{{$nationala->id}}/modificare">
                                <span class="material-icons">create</span>
                            </a>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Sterge echipa"
                                href ="/nationala/{{$nationala->id}}/stergere" onclick="return confirm('Sure Want Delete?')">
                                <span class="material-icons">remove_circle_outline</span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
  	</table>
@if( auth()->check() )
  	<a class="btn btn-primary" href ="/nationala/adaugare">Adaugare</a>
@endif

@endsection
