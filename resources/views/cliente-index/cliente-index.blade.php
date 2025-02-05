@extends('layouts.main')

@section('titulo', 'Inicio')

@section('contenido')

@include('layouts.partials.carrusel')

@include('layouts.partials.habitaciones-section')

@include('layouts.partials.experiencias-section')
@include('layouts.partials.blog-section')
@include('layouts.partials.testimonios-section')

@endsection