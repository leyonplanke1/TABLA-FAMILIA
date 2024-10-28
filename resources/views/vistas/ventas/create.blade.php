@extends('layouts.app')

@section('content')
    <form action="{{ route('ventas.store') }}" method="POST" id="ventaForm">
    @csrf

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Detalles de la venta</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="producto_select">Producto:</label>
                        <select id="producto_select" class="form-control">
                            <option value="" disabled selected>Seleccione un producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id_producto }}" 
                                        data-precio="{{ $producto->precio }}">
                                    {{ $producto->nombre }} - S/ {{ $producto->precio }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" class="form-control" id="cantidad" value="1" min="1">
                        </div>
                        <div class="col">
                            <label for="precio">Precio de venta:</label>
                            <input type="number" class="form-control" id="precio" readonly>
                        </div>
                        <div class="col">
                            <label for="descuento">Descuento:</label>
                            <input type="number" class="form-control" id="descuento" value="0" min="0">
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary mt-3" id="agregar_producto">Agregar</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>Datos generales</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="cliente_select">Cliente:</label>
                        <select id="cliente_select" name="id_cliente" class="form-control" required>
                            <option value="" disabled selected>Seleccione un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comprobante">Comprobante:</label>
                        <input type="text" class="form-control" name="comprobante" id="comprobante" required>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="impuesto">Impuesto (IGV):</label>
                            <input type="number" class="form-control" name="impuesto" id="impuesto" value="1.08" readonly>
                        </div>
                        <div class="col">
                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <table class="table mt-4" id="tabla_productos">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Venta</th>
                <th>Descuento</th>
                <th>Subtotal</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <!-- Campo oculto para enviar los productos -->
    <input type="hidden" name="productos" id="productos_input">
</form>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        const tablaProductos = $('#tabla_productos tbody');

        $('#producto_select').on('change', function () {
            const selectedOption = $(this).find(':selected');
            const precio = selectedOption.data('precio');
            $('#precio').val(precio ? parseFloat(precio).toFixed(2) : '');
        });

        $('#agregar_producto').on('click', function () {
            const productoSelect = $('#producto_select');
            const cantidad = $('#cantidad').val();
            const precio = $('#precio').val();
            const descuento = $('#descuento').val();
            const productoId = productoSelect.val();
            const productoNombre = productoSelect.find(':selected').text();

            if (!productoId) {
                alert('Seleccione un producto');
                return;
            }

            const subtotal = (cantidad * precio) - descuento;
            const row = `
                <tr data-id="${productoId}">
                    <td>${tablaProductos.children().length + 1}</td>
                    <td>${productoNombre}</td>
                    <td>${cantidad}</td>
                    <td>S/ ${precio}</td>
                    <td>S/ ${descuento}</td>
                    <td>S/ ${subtotal.toFixed(2)}</td>
                    <td><button class="btn btn-danger btn-sm eliminar">Eliminar</button></td>
                </tr>
            `;

            tablaProductos.append(row);
        });

        tablaProductos.on('click', '.eliminar', function () {
            $(this).closest('tr').remove();
        });

        $('#ventaForm').on('submit', function (e) {
            e.preventDefault();

            const productos = [];
            $('#tabla_productos tbody tr').each(function () {
                const row = $(this);
                const productoId = row.data('id');
                const cantidad = row.find('td:eq(2)').text();
                const descuento = row.find('td:eq(4)').text(); // Capturar el descuento del producto
                productos.push({ id_producto: productoId, cantidad: cantidad, descuento: descuento });
            });

            const formData = $(this).serializeArray();
            formData.push({ name: 'productos', value: JSON.stringify(productos) });

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function (response) {
                    window.location.href = "{{ route('ventas.index') }}";
                },
                error: function (error) {
                    alert('Error al guardar la venta.');
                }
            });
        });
    });
</script>
