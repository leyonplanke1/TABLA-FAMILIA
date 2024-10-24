@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Nuevo Producto</h1>

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="number" step="0.01" name="precio" required>
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="number" name="stock" required>
        </div>
        <div>
            <label for="foto">Foto:</label>
            <input type="text" name="foto">
        </div>
        <button type="submit" class="btn">Guardar</button>
    </form>
</div>
@endsection
