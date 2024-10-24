@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>

    <form action="{{ route('productos.update', $producto->id_producto) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="{{ $producto->nombre }}" required>
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" required>
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="number" name="stock" value="{{ $producto->stock }}" required>
        </div>
        <button type="submit" class="btn">Actualizar</button>
    </form>
</div>
@endsection
