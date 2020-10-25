@extends('layouts.app-navbar')

@section('content') 
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Data nasterii</th>
                <th>Nationalitate</th>
                <th>Inaltime</th>
                <th>Picior preferat</th>
                <th>Post</th>
                <th>Echipa</th>
                <th>Nationala</th>
                @if( auth()->check() )
                    <th>Actiuni</th>
                @endif
            </tr>
        </thead>
        <tbody>
           @foreach ($echipa->jucatori as $jucator)
            <tr>
                <td>{{ $jucator->nume }}</td>
                <td>{{ $jucator->data_nasterii }}</td>
                <td><img width="20px" class="img-circle" src="/images/{{$jucator->nationalitate}}.png"></td>
                <td>{{ $jucator->inaltime }}</td>
                <td>{{ $jucator->picior_preferat }}</td>
                <td>{{ $jucator->post }}</td>
                @if( !empty( $jucator->Echipa->nume ) )
                    <td>{{ $jucator->Echipa->nume }}</td>
                @else
                    <td>Fara echipa</td>
                @endif
                @if( !empty( $jucator->Nationala->nume ) )
                    <td>{{ $jucator->Nationala->nume }}</td>
                @else
                    <td>Fara nationala</td>
                @endif
                @if( auth()->check() )
                <td>
                <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica jucator"
                    href ="/jucator/{{$jucator->id}}/modificare">
                    <span class="material-icons">create</span>
                </a>
                <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Sterge jucator"
                    href ="/jucator/{{$jucator->id}}/stergere" onclick="return confirm('Sunteti sigur ca doriti stergerea?')">
                    <span class="material-icons">remove_circle_outline</span>
                </a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
@if( auth()->check() )
    <a class="btn btn-primary" href ="/jucator/adaugare">Adaugare</a>
@endif
@endsection