@extends('layouts.app-navbar')

@section('content')
<div class="custom_container"> 
    <form method="POST" action="/jucator/filtrare">
        {{ csrf_field() }}
        <div class="d-flex div_filter">
            <div class="field" style="margin-left:10px; margin-right: 15px;">
                <div class="control">
                    <button type="submit" class="btn btn-primary">                       
                     <span class="material-icons" style="vertical-align: middle;">search</span>
                     <span style="vertical-align: middle;">Filtreaza</span></button>
                </div>
            </div>
            <div class="input-group mb-3 col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nume</span>
                </div>
                <input type="text" class="form-control" name="Nume" value="{{old('Nume')}}" placeholder="Cauta nume">
            </div>
            <div class="input-group mb-3 col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Echipa</span>
                </div>
                <input type="text" name="echipa" id="cauta_echipa" class="form-control" placeholder="Cauta echipa" value="{{old('echipa')}}" />
            </div>
            <div class="input-group mb-3 col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nationalitate</span>
                </div>
                <input type="text" name="Nationalitate" id="cauta_tara" class="form-control" placeholder="Cauta tara" value="{{old('Nationalitate')}}">
            </div>
            @if( auth()->id() == 1 )
                <div class="text-right" style="margin-right: 10px; flex: auto;">
                    <a class="btn btn-adauga" href ="/jucator/adaugare">
                        <span class="material-icons" style="vertical-align: middle;">add</span>
                        <span style="vertical-align: middle;">Adauga</span>
                    </a>
                </div>
            @endif
        </div>
    </form>

    <table class="table table-striped">
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
                @if( auth()->id() == 1 )
                    <th style="width:10rem">Actiuni</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($jucatori as $jucator)
                <tr>
                    <td>{{ $jucator->nume }}</td>
                    <td>{{ $jucator->data_nasterii }}</td>
                    <td align="center">
                        <img width="20px" class="img-circle" src="/images/{{$jucator->nationalitate}}.png">
                    </td>
                    <td align="center">{{ $jucator->inaltime }}</td>
                    <td align="center">{{ $jucator->picior_preferat }}</td>
                    <td class="test">{{ $jucator->post }}</td>
                    @if ( !empty( $jucator->Echipa->nume ) )
                        <td>
                            {{ $jucator->Echipa->nume }}
                        </td>
                    @elseif( !empty( $jucator->echipa_id ) )
                        @php
                            $echipa = App\Echipa::findOrFail($jucator->echipa_id);
                        @endphp
                        <td>
                            {{ $echipa->nume }}
                        </td>
                    @else
                        <td>Fara echipa</td>
                    @endif

                    @if ( !empty( $jucator->Nationala->Tara->nume ) )
                        <td>
                            {{ $jucator->Nationala->Tara->nume }}
                        </td>
                    @elseif( !empty( $jucator->nationala_id ) )
                        @php
                            $nationala = App\Nationala::findOrFail($jucator->nationala_id);
                        @endphp
                        <td>
                            {{ $nationala->Tara->nume }}
                        </td>
                    @else
                        <td>Fara nationala</td>
                    @endif

                    @if( auth()->id() == 1 )
                        <td class="text-center">
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica jucator"
                                href ="/jucator/{{$jucator->id}}/modificare">
                                <span class="material-icons edit-icon">create</span>
                            </a>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Sterge jucator"
                                href ="/jucator/{{$jucator->id}}/stergere" onclick="return confirm('Sunteti sigur ca doriti stergerea?')">
                                <span class="material-icons remove-icon">remove_circle_outline</span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    @if( !empty( $jucatori->links() ) )
        <div>{{$jucatori->links()}}</div>
    @endif
</div>

  <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica jucator"
        href ="/jucator/piton">
        <span class="material-icons edit-icon">create</span>
    </a>

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