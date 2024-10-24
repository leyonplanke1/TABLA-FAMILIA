@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Ventas</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Agregar Nueva Venta</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Producto</th> <!-- Nueva columna Producto -->
                <th>Cantidad</th> <!-- Nueva columna Cantidad -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
            @foreach ($venta->ventaProductos as $ventaProducto) <!-- Relación con los productos de la venta -->
                    <tr>
                <tr>
                    <td>{{ $venta->id_venta }}</td>
                    <td>{{ $venta->cliente->nombre ?? 'Sin Cliente' }}</td>
                    <td>{{ $venta->fecha }}</td>
                    <td>{{ $venta->pagoTotal }}</td>
                    <td>{{ $ventaProducto->producto->nombre }}</td> <!-- Muestra el nombre del producto -->
                    <td>{{ $ventaProducto->cantidad }}</td> <!-- Muestra la cantidad del producto -->
                    <td>
                        <a href="{{ route('ventas.show', $venta->id_venta) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('ventas.edit', $venta->id_venta) }}" class="btn btn-warning">Editar</a> <!-- Botón Editar -->
                        <form action="{{ route('ventas.destroy', $venta->id_venta) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
</div>
@endsection
