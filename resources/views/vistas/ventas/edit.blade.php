@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Editar Venta</h1>

        <form action="{{ route('ventas.update', $venta->id_venta) }}" method="POST" id="ventaEditForm">
            @csrf
            @method('PUT')

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5>Editar Cliente y Productos</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="cliente_select">Editar Cliente:</label>
                                <select id="cliente_select" name="id_usuario" class="form-control" required>
                                    <option value="" disabled>Seleccione un cliente</option>
                                    @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id_usuario }}" 
                                                {{ $usuario->id_usuario == $venta->id_usuario ? 'selected' : '' }}>
                                            {{ $usuario->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5>Agregar o Eliminar Productos</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="producto_select">Producto:</label>
                                <select id="producto_select" class="form-control">
                                    <option value="" disabled>Seleccione un producto</option>
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
                                    <label for="precio">Precio:</label>
                                    <input type="number" class="form-control" id="precio" readonly>
                                </div>
                                <div class="col">
                                    <label for="descuento">Descuento:</label>
                                    <input type="number" class="form-control" id="descuento" value="0" min="0">
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary mt-3" id="agregar_producto">Agregar Producto</button>
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
                        <th>Precio</th>
                        <th>Descuento</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->ventaProductos as $producto)
                        <tr data-id="{{ $producto->id_producto }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $producto->producto->nombre }}</td>
                            <td>{{ $producto->cantidad }}</td>
                            <td>S/ {{ number_format($producto->precio, 2) }}</td>
                            <td>S/ {{ number_format($producto->descuento, 2) }}</td>
                            <td>S/ {{ number_format($producto->subtotal, 2) }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm eliminar">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Campos ocultos para total y pagoTotal -->
            <input type="hidden" name="total" id="total" value="{{ $venta->total ?? 0 }}">
            <input type="hidden" name="pagoTotal" id="pagoTotal" value="{{ $venta->pagoTotal ?? 0 }}">
            <input type="hidden" name="productos" id="productos_input">

            <button type="submit" class="btn btn-success mt-3">Guardar Cambios</button>
        </form>
    </div>

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

                if (!productoId || !cantidad || !precio) {
                    alert('Seleccione un producto y complete todos los campos');
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
                actualizarTotales();  // Actualiza los totales después de agregar
            });

            tablaProductos.on('click', '.eliminar', function () {
                $(this).closest('tr').remove();
                actualizarTotales();  // Actualiza los totales después de eliminar
            });

            $('#ventaEditForm').on('submit', function (e) {
                e.preventDefault();

                const productos = [];
                $('#tabla_productos tbody tr').each(function () {
                    const row = $(this);
                    const productoId = row.data('id');
                    const cantidad = parseInt(row.find('td:eq(2)').text());
                    const descuento = parseFloat(row.find('td:eq(4)').text()) || 0;
                    productos.push({ id_producto: productoId, cantidad: cantidad, descuento: descuento });
                });

                const formData = $(this).serializeArray();
                formData.push({ name: 'productos', value: JSON.stringify(productos) });

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function () {
                        window.location.href = "{{ route('ventas.index') }}";
                    },
                    error: function (xhr) {
                        alert('Error al guardar la venta: ' + xhr.responseText);
                    }
                });
            });

            function actualizarTotales() {
                let total = 0;

                $('#tabla_productos tbody tr').each(function() {
                    const precio = parseFloat($(this).find('td:eq(3)').text().replace('S/', '').trim()) || 0;
                    const descuento = parseFloat($(this).find('td:eq(4)').text().replace('S/', '').trim()) || 0;
                    const subtotal = precio - descuento;
                    total += subtotal;
                });

                $('#total').val(total.toFixed(2));
                $('#pagoTotal').val(total.toFixed(2)); // Puedes cambiar la lógica aquí si es necesario
            }
        });
    </script>
@endsection
