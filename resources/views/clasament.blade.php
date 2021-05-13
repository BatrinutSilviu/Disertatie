@extends('layouts.app-navbar')

@section('content')
<div class="custom_container jucatori"> 
    <table class="table table-striped">
    	 <thead>
            <tr class="text-center">
                <th>Loc</th>
                <th>Echipa</th>
                <th>Meciuri jucate</th>
				<th>Goluri date</th>
				<th>Goluri primite</th>
				<th>Golaveraj</th>
                <th>Puncte</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($echipe_competitii as $entitate)
            <tr>
            	<td align="center">{{$entitate->loc}}</td>
                @if(!empty($entitate->echipa))
	                <td align="center">{{$entitate->echipa->nume}}</td>
                @else
                    <td align="center">{{$entitate->nationala->tara->nume}}</td>
                @endif
            	<td align="center">{{$entitate->meciuri_jucate}}</td>
            	<td align="center">{{$entitate->goluri_date}}</td>
            	<td align="center">{{$entitate->goluri_primite}}</td>
				<td align="center">{{$entitate->gol_averaj}}</td>
				<td align="center">{{$entitate->puncte}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection