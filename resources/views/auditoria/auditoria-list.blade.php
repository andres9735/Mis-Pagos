@extends('dashboard')

@section('titulo_vista', 'modulo de auditoria')

@section('menu_vista')
    
@endsection

@section('contenido_vista')
    @livewire('auditoria.lista-auditorias')
@endsection