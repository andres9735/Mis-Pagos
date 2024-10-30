@extends('dashboard')

@section('titulo_vista', 'modulo de planes')

@section('menu_vista')
    @include('planes.main-nav')
@endsection

@section('contenido_vista')
    @livewire('planes.create-plan', ['solicitud' => $solicitud])
@endsection

