@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-4">
        <h1 class="text-3xl font-semibold mb-6">Registro de Auditoría</h1>
        <livewire:auditoria.lista-auditorias />
    </div>
@endsection
