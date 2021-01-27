@extends('layouts.app-navbar')

@section('content')

<div class="custom_container"> 
    <form method="POST" action="/meci/filtrare">
        {{ csrf_field() }}
        <div class="d-flex div_filter">
            <div class="field" style="margin-left:10px; margin-right: 15px;">
                <div class="control">
                    <button type="submit" class="btn btn-primary">
                     <span class="material-icons" style="vertical-align: middle;">search</span>
                     <span style="vertical-align: middle;">Filtreaza</span></button>
                    </button>
                </div>
            </div>
            <div class="input-group mb-3 col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Echipa</span>
                </div>
                <input type="text" name="echipa" id="cauta_echipa" class="form-control" placeholder="Cauta echipa" value="{{old('echipa')}}" />
            </div>
            <div class="input-group mb-3 col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Data</span>
                </div>
                <input type="date" name="data" id="cauta_data" max="3000-12-31" min="1000-01-01" placeholder="Cauta data" class="form-control" value="{{old('data')}}">
            </div>
            @if( auth()->id() == 1 )
                <div class="text-right" style="margin-right: 10px; flex: auto;">
                    <a class="btn btn-adauga" href ="/meci/adaugare">
                        <span class="material-icons" style="vertical-align: middle;">add</span>
                        <span style="vertical-align: middle;">Adauga</span>
                    </a>
                </div>
     @endif
        </div>
    </form>

    @if( auth()->id() == 1 )
    <table class="table table-striped">
    @else
    <table class="table table-striped jucatori">
    @endif
        <thead>
            <tr class="text-center">
                <th>Echipa gazda</th>
                <th>Scor</th>
                <th>Echipa oaspete</th>
                <th>Competitie</th>
                <th>Data</th>
                @if( auth()->id() == 1 )
                    <th style="width:10rem">Actiuni</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($meciuri as $meci)
                <tr>
                    @if ( !empty( $meci->echipa_gazda->nume ) )
                        <td align="center">{{ $meci->echipa_gazda->nume }}</td>
                    @else
                        @php
                            $echipa = App\Echipa::findOrFail($meci->echipa_gazda_id);
                        @endphp
                        <td align="center">
                            {{ $echipa->nume }}
                        </td>
                    @endif
                    <td align="center">{{ $meci->goluri_gazde }} - {{ $meci->goluri_oaspeti }}</td>
                    @if ( !empty( $meci->echipa_oaspete->nume ) )
                        <td align="center">{{ $meci->echipa_oaspete->nume }}</td>
                    @else
                        @php
                            $echipa = App\Echipa::findOrFail($meci->echipa_oaspete_id);
                        @endphp
                        <td align="center">
                            {{ $echipa->nume }}
                        </td>
                    @endif
                    @if ( !empty( $meci->competitie->nume ) )
                        <td align="center">{{ $meci->competitie->nume }}</td>
                    @else
                        @php
                            $competitie = App\Competitie::findOrFail($meci->competitie_id);
                        @endphp
                        <td align="center">
                            {{ $competitie->nume }}
                        </td>
                    @endif
                    <td align="center">{{ $meci->data }}</td>
                    @if( auth()->id() == 1 )
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
    <div>{{$meciuri->links()}}</div>
</div>

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