@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detalles de la Venta</h1>

        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5>Información de la Venta</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Cliente:</strong> {{ $venta->cliente ? $venta->cliente->nombre : 'Sin cliente' }}</p>

                        <p><strong>Comprobante:</strong> {{ $venta->comprobante }}</p>
                        <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Impuesto (IGV):</strong> {{ $venta->impuesto }}</p>
                        <p><strong>Total:</strong> S/ {{ number_format($venta->total, 2) }}</p>
                        <p><strong>Descuento:</strong> S/ {{ number_format($venta->descuento, 2) }}</p>
                        <p><strong>Total Pagado:</strong> S/ {{ number_format($venta->pagoTotal, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h3>Productos</h3>
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->ventaProductos as $producto)
                    <tr>
                        <td>{{ $producto->producto->nombre }}</td>
                        <td>{{ $producto->cantidad }}</td>
                        <td>S/ {{ number_format($producto->precio, 2) }}</td>
                        <td>S/ {{ number_format($producto->descuento, 2) }}</td>
                        <td>S/ {{ number_format($producto->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('ventas.index') }}" class="btn btn-primary mt-3">Volver al Listado</a>
    </div>
    
@endsection

