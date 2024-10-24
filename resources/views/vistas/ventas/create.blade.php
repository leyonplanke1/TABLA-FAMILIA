@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nueva Venta</h1>

        <!-- Formulario para crear una nueva venta -->
        <form action="{{ route('ventas.store') }}" method="POST">
            @csrf <!-- Protección CSRF para evitar ataques de tipo Cross-Site Request Forgery -->

            <!-- Campo de Fecha -->
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <!-- Input para ingresar la fecha y hora de la venta -->
                <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
            </div>

            <!-- Selección de Producto usando un select -->
            <div class="form-group">
                <label for="producto_select">Buscar y Seleccionar Producto</label>
                <select id="producto_select" class="form-control">
                    <option value="" disabled selected>Selecciona un producto</option>
                    <!-- Iteración de productos disponibles en la base de datos -->
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id_producto }}" 
                                data-nombre="{{ $producto->nombre }}" 
                                data-precio="{{ $producto->precio }}">
                            {{ $producto->nombre }} - S/ {{ $producto->precio }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tabla dinámica que muestra los productos seleccionados -->
            <table class="table mt-3" id="tabla_productos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody></tbody> <!-- Cuerpo dinámico que se llenará con JavaScript -->
            </table>

            <!-- Selección del cliente -->
            <div class="form-group">
                <label for="cliente_select">Cliente</label>
                <select id="cliente_select" name="id_cliente" class="form-control">
                    <option value="" disabled selected>Selecciona un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Campo para mostrar el total de la venta -->
            <div class="form-group">
                <label for="total">Total:</label>
                <input type="number" class="form-control" id="total" name="total" readonly>
            </div>

            <!-- Campo de descuento -->
            <div class="form-group">
                <label for="descuento">Descuento:</label>
                <input type="number" class="form-control" id="descuento" name="descuento" step="0.01" value="0.00">
            </div>

            <!-- Campo de total a pagar después del descuento -->
            <div class="form-group">
                <label for="total_pagar">Total a Pagar:</label>
                <input type="number" id="total_pagar" name="pagoTotal" class="form-control" readonly>
            </div>

            <!-- Botones de acción: anular y procesar venta -->
            <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-danger" id="anular_venta">Anular Venta</button>
                <button type="submit" class="btn btn-success">Procesar Venta</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <!-- Importar jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Importar Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Importar Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" 
            crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            // Aplicar Select2 a los selectores de producto y cliente
            $('#producto_select, #cliente_select').select2();

            // Evento: Cuando se selecciona un producto
            $('#producto_select').on('change', function () {
                const selectedOption = $(this).find(':selected'); // Opción seleccionada
                const idProducto = selectedOption.val(); // ID del producto
                const nombreProducto = selectedOption.data('nombre'); // Nombre del producto
                const precioProducto = parseFloat(selectedOption.data('precio')); // Precio del producto

                // Verificar si el producto ya fue agregado
                if ($(`#tabla_productos tr[data-id="${idProducto}"]`).length > 0) {
                    alert('Este producto ya ha sido agregado.');
                    return;
                }

                // Agregar el producto a la tabla
                agregarProductoATabla(idProducto, nombreProducto, precioProducto);
                actualizarTotal(); // Actualizar el total
                $(this).val(null).trigger('change'); // Resetear el selector
            });

            // Función para agregar un producto a la tabla
            function agregarProductoATabla(idProducto, nombreProducto, precioProducto) {
                const fila = `
                    <tr data-id="${idProducto}">
                        <td>${idProducto}</td>
                        <td>${nombreProducto}</td>
                        <td><input type="number" class="form-control cantidad" value="1" min="1"></td>
                        <td>${precioProducto.toFixed(2)}</td>
                        <td class="total">${precioProducto.toFixed(2)}</td>
                        <td><button type="button" class="btn btn-danger btn-sm eliminar">Eliminar</button></td>
                    </tr>
                `;
                $('#tabla_productos tbody').append(fila); // Agregar la fila al cuerpo de la tabla
            }

            // Evento: Eliminar un producto de la tabla
            $('#tabla_productos').on('click', '.eliminar', function () {
                $(this).closest('tr').remove(); // Eliminar la fila seleccionada
                actualizarTotal(); // Actualizar el total
            });

            // Evento: Cambiar la cantidad del producto
            $('#tabla_productos').on('input', '.cantidad', function () {
                const fila = $(this).closest('tr'); // Fila actual
                const precio = parseFloat(fila.find('td:eq(3)').text()); // Precio del producto
                const cantidad = parseInt($(this).val()); // Nueva cantidad ingresada
                const total = precio * cantidad; // Calcular total por producto
                fila.find('.total').text(total.toFixed(2)); // Actualizar el total en la fila
                actualizarTotal(); // Actualizar el total general
            });

            // Función para actualizar el total y el total a pagar con descuento
            function actualizarTotal() {
                let total = 0;
                let descuento = parseFloat($('#descuento').val()); // Leer descuento

                // Calcular el total sumando los subtotales de cada fila
                $('#tabla_productos tbody tr').each(function () {
                    total += parseFloat($(this).find('.total').text());
                });

                $('#total').val(total.toFixed(2)); // Mostrar el total
                const totalPagar = total - descuento; // Aplicar descuento
                $('#total_pagar').val(totalPagar.toFixed(2)); // Mostrar total a pagar
            }

            // Evento: Cuando cambia el descuento
            $('#descuento').on('input', function () {
                actualizarTotal(); // Actualizar total al cambiar el descuento
            });

            // Evento: Anular la venta (resetear el formulario)
            $('#anular_venta').click(function () {
                $('#tabla_productos tbody').empty(); // Vaciar la tabla
                $('#total').val(0); // Resetear total
                $('#total_pagar').val(0); // Resetear total a pagar
                $('#descuento').val(0); // Resetear descuento
            });
        });
    </script>
@endsection
