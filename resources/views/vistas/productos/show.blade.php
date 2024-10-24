@extends('layouts.app')

@section('content')
    <h1>Detalles del Producto</h1>

    <div class="form-group">
        <strong>Nombre:</strong> {{ $producto->nombre }}
    </div>

    <div class="form-group">
        <strong>Descripción:</strong> {{ $producto->descripcion }}
    </div>

    <div class="form-group">
        <strong>Precio:</strong> {{ $producto->precio }}
    </div>

    <div class="form-group">
        <strong>Cantidad en Stock:</strong> {{ $producto->cantidad_stock }}
    </div>

    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar</a>

    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
    </form>
@endsection
