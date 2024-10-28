@extends('layouts.app') <!-- Extiende la plantilla principal -->

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Listado de Ventas</h1> <!-- Título de la página -->
            <a href="{{ route('ventas.create') }}" class="btn btn-primary">Crear Venta</a> <!-- Botón para crear una venta -->
        </div>

        <!-- Mostrar mensaje de éxito al registrar una venta -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla para listar las ventas -->
        <table class="table table-striped mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>#</th> <!-- Número de venta -->
                    <th>Cliente</th> <!-- Nombre del cliente -->
                    <th>SubTotal</th> <!-- Total de la venta -->
                    <th>Descuento</th> <!-- Descuento aplicado -->
                    <th>Total Pagado</th> <!-- Pago total -->
                    <th>Fecha</th> <!-- Fecha de la venta -->
                    <th>Acciones</th> <!-- Acciones (editar/eliminar) -->
                </tr>
            </thead>
            <tbody>
                @forelse($ventas as $venta) <!-- Itera sobre las ventas -->
                    <tr>
                        <td>{{ $loop->iteration }}</td> <!-- Número de venta -->
                        <td>{{ $venta->cliente ? $venta->cliente->nombre : 'Sin cliente' }}</td> <!-- Validación de cliente -->
                        <td>S/ {{ number_format($venta->total, 2) }}</td> <!-- Total con formato -->
                        <td>S/ {{ number_format($venta->descuento, 2) }}</td> <!-- Descuento -->
                        <td>S/ {{ number_format($venta->pagoTotal, 2) }}</td> <!-- Pago Total -->
                        <td>{{ $venta->fecha }}</td> <!-- Fecha de la venta -->
                        <td>

                            <!-- Botón "Ver" -->
                            <a href="{{ route('ventas.show', $venta->id_venta) }}" class="btn btn-info btn-sm">Ver</a>

                            <!-- Botón de edición -->
                            <a href="{{ route('ventas.edit', $venta->id_venta) }}" class="btn btn-warning btn-sm">Editar</a>

                            <!-- Botón de eliminación -->
                            <form action="{{ route('ventas.destroy', $venta->id_venta) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta venta?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay ventas registradas.</td> <!-- Mensaje si no hay ventas -->
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
