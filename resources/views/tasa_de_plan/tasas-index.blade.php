@extends('dashboard')
@section('titulo_vista', 'modulo tasas')

@section('menu_vista')
    @include('tasa_de_plan.main-nav')
@endsection

@section('contenido_vista')
    @livewire('tasa.list-tasas') <!-- Incluye el componente Livewire aquí -->
@endsection

