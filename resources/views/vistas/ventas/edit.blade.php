@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Editar Venta #{{ $venta->id_venta }}</h1>

    <form action="{{ route('ventas.update', $venta->id_venta) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select name="id_cliente" class="form-control">
                <option value="">Sin cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}" 
                        {{ $cliente->id_cliente == $venta->id_cliente ? 'selected' : '' }}>
                        {{ $cliente->nombre }} {{ $cliente->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="productos">Productos</label>
            <select multiple name="productos[]" class="form-control" required>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id_producto }}" 
                        @foreach ($venta->ventaProductos as $vp)
                            {{ $producto->id_producto == $vp->id_producto ? 'selected' : '' }}
                        @endforeach
                    >
                        {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" name="total" class="form-control" value="{{ $venta->total }}" required>
        </div>

        <div class="form-group">
            <label for="descuento">Descuento</label>
            <input type="number" name="descuento" class="form-control" value="{{ $venta->descuento }}">
        </div>

        <div class="form-group">
            <label for="pagoTotal">Pago Total</label>
            <input type="number" name="pagoTotal" class="form-control" value="{{ $venta->pagoTotal }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Venta</button>
    </form>
</div>

@endsection
