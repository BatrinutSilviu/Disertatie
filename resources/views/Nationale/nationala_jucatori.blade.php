@extends('layouts.app-navbar')

@section('content') 
<h1 align="center">{{$nationala->tara->nume}}</h1>
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
                <th>Echipa</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($nationala->jucatori as $jucator)
            <tr>
                <td align="center">{{ $jucator->nume }}</td>
                <td align="center">{{ $jucator->data_nasterii }}</td>
                <td align="center"><img width="20px" class="img-circle" src="/images/{{$jucator->nationalitate}}.png"></td>
                <td align="center">{{ $jucator->inaltime }}</td>
                <td align="center">{{ $jucator->picior_preferat }}</td>
                <td align="center">{{ $jucator->post }}</td>
                @if( !empty( $jucator->Echipa->nume ) )
                    <td align="center">{{ $jucator->Echipa->nume }}</td>
                @else
                    <td align="center">Fara echipa</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection