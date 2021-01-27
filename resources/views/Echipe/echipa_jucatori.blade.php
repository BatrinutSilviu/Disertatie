@extends('layouts.app-navbar')

@section('content') 
<h1 align="center">{{$echipa->nume}}</h1>
<div class="custom_container"> 
    <table class="table table-striped jucatori">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Data nasterii</th>
                <th>Nationalitate</th>
                <th>Inaltime</th>
                <th>Picior preferat</th>
                <th>Post</th>
                <th>Nationala</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($echipa->jucatori as $jucator)
            <tr>
                <td align="center">{{ $jucator->nume }}</td>
                <td align="center">{{ $jucator->data_nasterii }}</td>
                <td align="center"><img width="20px" class="img-circle" src="/images/{{$jucator->nationalitate}}.png"></td>
                <td align="center">{{ $jucator->inaltime }}</td>
                <td align="center">{{ $jucator->picior_preferat }}</td>
                <td align="center">{{ $jucator->post }}</td>
                @if( !empty( $jucator->Nationala->nume ) )
                    <td align="center">{{ $jucator->Nationala->nume }}</td>
                @else
                    <td align="center">Fara nationala</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection