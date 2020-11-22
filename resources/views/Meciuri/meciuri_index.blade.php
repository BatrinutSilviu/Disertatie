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
                <th style="width:10rem">Actiuni</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($meciuri as $meci)
            <tr>
                <td>{{ $meci->echipa_gazda->nume }}</td>
                <td>{{ $meci->echipa_oaspete->nume }}</td>
                <td align="center">{{ $meci->data }}</td>
                <td align="center">{{ $meci->goluri_gazde }} - {{ $meci->goluri_oaspeti }}</td>
                <td>{{ $meci->competitie->nume }}</td>
                <td>{{ $meci->teren }}</td>
                <td>{{ $meci->arbitru }}</td>

                @if( auth()->check() )
                    <td class="text-center">
                        <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica meci"
                            href ="/meci/{{$meci->id}}/modificare">
                            <span class="material-icons edit-icon">create</span>
                        </a>
                        <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Sterge meci"
                            href ="/meci/{{$meci->id}}/stergere" onclick="return confirm('Sunteti sigur ca doriti stergerea?')">
                            <span class="material-icons remove-icon">remove_circle_outline</span>
                        </a>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@if( auth()->check() )
    <div align="right">
        <a class="btn btn-primary" href ="/meci/adaugare">Adaugare</a>
    </div>
 @endif

@endsection