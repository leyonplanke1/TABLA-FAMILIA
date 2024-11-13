@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Listado de Ventas</h1>
            <a href="{{ route('ventas.create') }}" class="btn btn-primary">Crear Venta</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>SubTotal</th>
                    <th>Total Pagado</th>
                    <th>Fecha</th>
                    <th>Estado de Envío</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ventas as $venta)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $venta->usuario ? $venta->usuario->nombre . ' ' . $venta->usuario->apellido : '' }}</td>
                        <td>S/ {{ number_format($venta->total, 2) }}</td>
                        <td>S/ {{ number_format($venta->pagoTotal, 2) }}</td>
                        <td>{{ $venta->fecha }}</td>
                        <td>
                            <!-- Selector de estado de envío -->
                            <form action="{{ route('ventas.cambiarEstado', $venta->id_venta) }}" method="POST" style="display: inline;">
                                @csrf
                                @if($venta->estado_envio == 'pendiente')
                                    <input type="hidden" name="estado_envio" value="enviado">
                                    <button type="submit" class="btn btn-sm" style="background-color: #ff69b4; color: white;">Pendiente</button>
                                @else
                                    <input type="hidden" name="estado_envio" value="pendiente">
                                    <button type="submit" class="btn btn-sm btn-success">Enviado</button>
                                @endif
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('ventas.show', $venta->id_venta) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('ventas.edit', $venta->id_venta) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('ventas.destroy', $venta->id_venta) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta venta?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay ventas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

