@extends('dashboard')
@section('titulo_vista', 'modulo de solicitudes')

@section('menu_vista')
    @include('solicitudes.main-nav')
@endsection

@section('contenido_vista')
    @livewire('users.create-solicitud-plan-de-pago')
@endsection