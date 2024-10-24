@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Detalles de la Venta #{{ $venta->id_venta }}</h1>

    <p><strong>Cliente:</strong> {{ $venta->cliente->nombre ?? 'Sin Cliente' }}</p>
    <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
    <p><strong>Total:</strong> {{ $venta->total }}</p>
    <p><strong>Descuento:</strong> {{ $venta->descuento }}</p>
    <p><strong>Pago Total:</strong> {{ $venta->pagoTotal }}</p>

    <h4>Productos</h4>
    <ul>
        @foreach ($venta->ventaProductos as $ventaProducto)
            <li>{{ $ventaProducto->producto->nombre }} (Cantidad: {{ $ventaProducto->cantidad }})</li>
        @endforeach
    </ul>

    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver a la lista</a>
</div>

@endsection
