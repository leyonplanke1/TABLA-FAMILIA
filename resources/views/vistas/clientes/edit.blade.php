@extends('layouts.app')

@section('content')

<!-- Botón de regresar o atrás -->
<div class="d-flex justify-content-start mt-3">
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Regresar</a>
</div>

<div class="container mt-5">
    <h1 class="mb-4">Editar Cliente</h1>

    <!-- Mostrar errores de validación -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario para editar cliente -->
    <form action="{{ route('clientes.update', $cliente->id_cliente) }}" method="POST" class="p-4 shadow-sm bg-white rounded">
        @csrf
        @method('PUT')

        <!-- DNI -->
        <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" name="dni" class="form-control" value="{{ $cliente->dni }}" required>
        </div>

        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}" required>
        </div>

        <!-- Apellido -->
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ $cliente->apellido }}" required>
        </div>

        <!-- Teléfono -->
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ $cliente->telefono }}">
        </div>

        <!-- Dirección -->
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ $cliente->direccion }}">
        </div>

        <!-- Correo -->
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" name="correo" class="form-control" value="{{ $cliente->correo }}" required>
        </div>

        <!-- Botón de actualizar -->
        <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
    </form>
</div>

@endsection
