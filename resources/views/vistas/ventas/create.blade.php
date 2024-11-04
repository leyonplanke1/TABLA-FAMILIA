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
                        <label for="usuario_select">Usuario:</label>
                        <select id="usuario_select" name="id_usuario" class="form-control" required>
                            <option value="" disabled selected>Seleccione un usuario</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" required>
                        </div>
                    </div>

                    


                    <!-- En tu HTML: Añade un ID al botón de guardar -->
<button type="submit" id="guardar_venta" class="btn btn-success mt-3">
    Guardar <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
</button>

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
                <th>Subtotal</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

    <!-- Campo oculto para enviar los productos -->
    <input type="hidden" name="productos" id="productos_input">
</form>


 
            </div>
        </div>
    </div>
</div>



@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


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
            const productoId = productoSelect.val();
            const productoNombre = productoSelect.find(':selected').text();

            if (!productoId) {
                alert('Seleccione un producto');
                return;
            }

            const subtotal = cantidad * precio;
            const row = `
                <tr data-id="${productoId}">
                    <td>${tablaProductos.children().length + 1}</td>
                    <td>${productoNombre}</td>
                    <td>${cantidad}</td>
                    <td>S/ ${precio}</td>
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

            // Deshabilitar botón y mostrar spinner
            $('#guardar_venta').prop('disabled', true);
            $('#spinner').removeClass('d-none');

            const productos = [];
            $('#tabla_productos tbody tr').each(function () {
                const row = $(this);
                const productoId = row.data('id');
                const cantidad = row.find('td:eq(2)').text();
                productos.push({ id_producto: productoId, cantidad: cantidad });
            });

            const formData = $(this).serializeArray();
            formData.push({ name: 'productos', value: JSON.stringify(productos) });

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function (response) {
                    // Redirigir al listado de ventas si se guarda correctamente
                    window.location.href = "{{ route('ventas.index') }}";
                },
                error: function (error) {
                    alert('Error al guardar la venta.');
                    // Habilitar botón y ocultar spinner en caso de error
                    $('#guardar_venta').prop('disabled', false);
                    $('#spinner').addClass('d-none');
                }
            });
        });
    });
</script>

