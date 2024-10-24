{{-- resources/views/clientes/show.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Detalles del Cliente</h1>

    <!-- Tarjeta con los detalles del cliente -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2>{{ $cliente->nombre }} {{ $cliente->apellido }}</h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>DNI:</strong> {{ $cliente->dni }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Correo:</strong> {{ $cliente->correo }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="mt-4 d-flex justify-content-between">
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver a la lista de clientes</a>
        <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-warning">Editar Cliente</a>
    </div>
</div>
@endsection
