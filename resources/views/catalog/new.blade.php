@extends('layouts.master')

@section('title', 'catalog creamosh')

@section('content')



<div class="row"> 
    <div class="col-sm-4"> 
        <<img url="{{$pelicula->poster}}" style="height:200px"/> </div> 
        <div class="col-sm-8"> 

        <h2>  {{$pelicula->title }} </h2> 

        <h4> Año: {{ $pelicula->year}}</h4>

        <h5> Director: {{ $pelicula->director}} </h5> <br>

        <p> <strong>Sinopsis:</strong> {{ $pelicula->synopsis}}</p>   
        
        


@endsection