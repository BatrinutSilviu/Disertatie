@extends('layouts.app-navbar')

@section('content')

<table class="table table-striped table-bordered">
    <thead>
        <tr class="text-center">
            <th>Echipa gazda</th>
            <th>Echipa oaspete</th>
            <th>Data</th>
            <th>Scor</th>
            <th>Competitie</th>
            <th>Teren</th>
            <th>Arbitru</th>
            @if( auth()->check() )
                <th>Actiuni</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($meciuri as $meci)
            <tr>
                <td>{{ $meci->echipa_gazda_id->Nume }}</td>
                <td>{{ $meci->echipa_oaspete_id->Nume }}</td>
                <td>{{ $meci->data }}</td>
                <td>{{ $meci->goluri_gazde }} - {{ $meci->goluri_oaspeti }}</td>
                <td>{{ $meci->competitie_id->nume }}</td>
                <td>{{ $meci->teren }}</td>
                <td>{{ $meci->arbitru }}</td>

                @if( auth()->check() )
                    <td>
                        <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica meci"
                            href ="/meci/{{$meci->id}}/modificare">
                            <span class="material-icons">create</span>
                        </a>
                        <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Sterge meci"
                            href ="/meci/{{$meci->id}}/stergere" onclick="return confirm('Sunteti sigur ca doriti stergerea?')">
                            <span class="material-icons">remove_circle_outline</span>
                        </a>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@if( auth()->check() )
    <a class="btn btn-primary" href ="/meci/adaugare">Adaugare</a>
 @endif

@endsection