@extends('layouts.app-navbar')

@section('content')
<div class="row">
    <div class="col-2">
        <form method="POST" action="/jucator/filtrare">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nume</span>
                </div>
                <input type="text" class="form-control" name="Nume" value="{{old('Nume')}}" placeholder="Cauta nume">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Echipa</span>
                </div>
                <input type="text" name="echipa" id="cauta_echipa" class="form-control" placeholder="Cauta echipa" value="{{old('echipa')}}" />
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nationalitate</span>
                </div>
                <input type="text" name="Nationalitate" id="cauta_tara" class="form-control" placeholder="Cauta tara" value="{{old('Nationalitate')}}">
            </div>
            <button class="btn btn-primary" type="submit">Filtreaza</button>
        </form>
    </div>

    <table class="table table-striped table-bordered col-10">
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
            @foreach ($jucatori as $jucator)
                <tr>
                    <td>{{ $jucator->Nume }}</td>
                    <td>{{ $jucator->Data_Nasterii }}</td>
                    <td><img width="20px" class="img-circle" src="/images/{{$jucator->Nationalitate}}.png"></td>
                    <td>{{ $jucator->Inaltime }}</td>
                    <td>{{ $jucator->Picior_preferat }}</td>
                    <td class="test">{{ $jucator->Post }}</td>
                    @if ( !empty( $jucator->Echipa->Nume ) )
                        <td>
                            {{ $jucator->Echipa->Nume }}
                        </td>
                    @elseif( !empty( $jucator->echipa_id ) )
                        @php
                            $echipa = App\Echipa::findOrFail($jucator->echipa_id);
                        @endphp
                        <td>
                            {{ $echipa->Nume }}
                        </td>
                    @else
                        <td>Fara echipa</td>
                    @endif

                    @if ( !empty( $jucator->Nationala->Nume ) )
                        <td>
                            {{ $jucator->Nationala->Nume }}
                        </td>
                    @elseif( !empty( $jucator->nationala_id ) )
                        @php
                            $nationala = App\Nationala::findOrFail($jucator->nationala_id);
                        @endphp
                        <td>
                            {{ $nationala->Nume }}
                        </td>
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
</div>
@if( auth()->check() )
    <div align="center">
        <a class="btn btn-primary" href ="/jucator/adaugare">Adaugare</a>
    </div>
@endif

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="Stylesheet" />
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){

    $("#cauta_echipa").autocomplete({
        source: function(request, response) {
             $.ajax({
                url:"{{ route('echipa.cauta') }}",
                method:'GET',
                dataType:'json',
                data: {
                    search: request.term
                },
                success:function(data) {
                    response(data);
                }
            })
        }
    });
    $("#cauta_tara").autocomplete({
        source: function(request, response) {
             $.ajax({
                url:"{{ route('tara.cauta') }}",
                method:'GET',
                dataType:'json',
                data: {
                    search: request.term
                },
                success:function(data) {
                    response(data);
                }
            })
        }
    });
});
</script>

@endsection