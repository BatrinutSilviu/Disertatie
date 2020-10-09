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
           @foreach ($nationala->jucatori as $jucator)
            <tr>
                <td>{{ $jucator->Nume }}</td>
                <td>{{ $jucator->Data_Nasterii }}</td>
                <td><img width="20px" class="img-circle" src="/images/{{$jucator->Nationalitate}}.png"></td>
                <td>{{ $jucator->Inaltime }}</td>
                <td>{{ $jucator->Picior_preferat }}</td>
                <td>{{ $jucator->Post }}</td>
                <td>{{ $jucator->Echipa->Nume }}</td>
                <td>{{ $jucator->Nationala->Nume }}</td>
                @if( auth()->check() )
                <td>
                <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica jucator"
                    href ="/nationala/{{$nationala->id}}/modificare">
                    <span class="material-icons">create</span>
                </a>
                <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Sterge jucator"
                    href ="/nationala/{{$nationala->id}}/stergere">
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