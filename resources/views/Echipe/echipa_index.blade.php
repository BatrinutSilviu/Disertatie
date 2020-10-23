@extends('layouts.app-navbar')

@section('content') 
<div class="row">
    <div class="col-2">
        <form method="POST" action="/echipa/filtrare">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nume</span>
                </div>
                <input type="text" class="form-control" name="Nume" value="{{old('Nume')}}" placeholder="Cauta nume">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Tara</span>
                </div>
                <input type="text" name="Tara" id="cauta_tara" class="form-control" placeholder="Cauta tara" value="{{old('Tara')}}">
            </div>
            <button class="btn btn-primary" type="submit">Filtreaza</button>
        </form>
    </div>

	<table class="table table-striped table-bordered col-10">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Tara</th>
                <th>Liga</th>
                <th>Manager</th>
                @if( auth()->check() )
                    <th>Actiuni</th>
                @endif
                
            </tr>
        </thead>
        <tbody>
            @foreach ($echipe as $echipa)
                <tr>
                    <td>
                        <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Lot"
                            href ="/echipa/{{$echipa->id}}/jucatori">{{ $echipa->Nume }}</a>
                    </td>
                    <td><img width="20px" class="img-circle" src="/images/{{$echipa->Tara->Prescurtare}}.png"></td>
                    <td>{{ $echipa->Liga }}</td>
                    <td>{{ $echipa->Manager }}</td>
                    @if( auth()->check() )
                        <td>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica echipa"
                                href ="/echipa/{{$echipa->id}}/modificare">
                                <span class="material-icons">create</span>
                            </a>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Sterge echipa"
                                href ="/echipa/{{$echipa->id}}/stergere" onclick="return confirm('Sunteti sigur ca doriti stergerea?')">
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
	   <a class="btn btn-primary" href ="/echipa/adaugare">Adaugare</a>
    </div>
@endif

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="Stylesheet" />
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){

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
