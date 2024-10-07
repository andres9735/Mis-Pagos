@extends('dashboard')
@section('titulo_vista', 'modulo usuarios')

@section('menu_vista')
    @include('users.main-nav')
@endsection

@section('contenido_vista')
    @livewire('users.create-solicitud-plan-de-pago')
@endsection