@extends('dashboard')

@section('titulo_vista', 'modulo de usuarios')

@section('menu_vista')
    @include('users.main-nav')
@endsection

@section('contenido_vista')
    @livewire('users.edit-usuario', ['id'=>$id])
@endsection