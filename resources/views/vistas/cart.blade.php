<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - La Familia</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

          .form-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        .form-section h2 {
            font-size: 18px;
            color: #333;
        }

        .form-section label {
            font-weight: bold;
        }

        .form-section select, .form-section input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .btn {
            background-color: #FF5733;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #D2691E;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            padding: 20px;
            color: #333;
        }

        .pay-button {
            display: block;
            width: 100%;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            font-size: 18px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .pay-button:hover {
            background-color: #45a049;
        }

        .form-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        .form-section h2 {
            font-size: 18px;
            color: #333;
        }

        .form-section label {
            font-weight: bold;
        }

        .payment-methods {
            margin-top: 20px;
        }

        .payment-methods label {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .payment-methods input[type="radio"] {
            margin-right: 10px;
        }
        
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-controls button {
            padding: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .quantity-controls input {
            width: 50px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }


    </style>

<script src="https://www.paypal.com/sdk/js?client-id=Ads-LChTmvJJE2Qd13s1dLAQ4RwvP5YoTHYjcrMpS2kyhG0HLlmO-DwNA8ExOI3z5LkvowuQ4sDqGSvc"></script>


</head>

<body>
    

    <h1 style="text-align: center; margin-top: 20px;">Carrito de Compras</h1>
    <div class="d-flex justify-content-start mt-3">
        <a href="{{ route('tienda.index') }}" class="btn btn-secondary">Regresar</a>
    </div>
    <div class="container">
        @if(session('cart'))
         <!-- Formulario para método de envío y pago -->
         <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <div class="form-section">
                <h2>Información de Envío</h2>
                <label for="direccion">Dirección de Envío(Solo Concepción y Alrededores):</label>
                <input type="text" id="direccion" name="direccion" required placeholder="Ingrese la dirección de entrega">

                <label for="metodo_envio">Método de Envío:</label>
                <select id="metodo_envio" name="metodo_envio" required>
                    <option value="estandar">Envío Estándar - S/. 5.00</option>
                    
                </select>
            </div>

            <div class="form-section payment-methods">
                <h2>Método de Pago</h2>
                <label>
                    <input type="radio" name="metodo_pago" value="paypal" required>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" width="30">
                    PayPal
                </label>
                <label>
                    <input type="radio" name="metodo_pago" value="contraentrega">
                    <img src="https://files.oaiusercontent.com/file-uVcJQdIgpwFRbK4iP846tQiw?se=2024-11-13T03%3A33%3A32Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D44db6d96-e56e-4639-8f5a-0dce536d56e9.webp&sig=05ihzZIeVNvviy8w7uchpYVYmYrCXhYZHMw2FynP8Xo%3D" alt="Contraentrega" width="30">
                    Contraentrega
                </label>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('cart') as $id => $producto)
                        <tr>
                            <td><input type="checkbox" class="product-select" data-id="{{ $id }}"></td>
                            <td>{{ $producto['nombre'] }}</td>
                            <td>
                                <div class="quantity-controls">
                                    <button type="button" onclick="updateQuantity({{ $id }}, -1)">−</button>
                                    <input type="text" id="quantity-{{ $id }}" value="{{ $producto['cantidad'] }}" readonly>
                                    <button type="button" onclick="updateQuantity({{ $id }}, 1)">+</button>
                                </div>
                                <input type="hidden" name="quantities[{{ $id }}]" id="input-quantity-{{ $id }}" value="{{ $producto['cantidad'] }}">
                            </td>
                            <td>S/. <span id="price-{{ $id }}" data-price="{{ $producto['precio'] }}">{{ number_format($producto['precio'], 2) }}</span></td>
                            <td>S/. <span id="subtotal-{{ $id }}">{{ number_format($producto['precio'] * $producto['cantidad'], 2) }}</span></td>
                            <td>
                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

           
                <div class="total">
                    Total a pagar: S/. <span id="total">{{ number_format($total, 2) }}</span>
                </div>
                <!-- Botón de PayPal -->
<div id="paypal-button-container" style="display:none;"></div>  <!-- Inicialmente oculto -->

<!-- Botón de Pago Contraentrega -->
<button type="submit" class="pay-button" style="display:none;">Realizar compra</button> <!-- Inicialmente oculto -->


                

           
            
         </form>
        @else
            <p>No hay productos en el carrito.</p>
        @endif
    </div>

    
     
    <script src="https://www.paypal.com/sdk/js?client-id=Ads-LChTmvJJE2Qd13s1dLAQ4RwvP5YoTHYjcrMpS2kyhG0HLlmO-DwNA8ExOI3z5LkvowuQ4sDqGSvc"></script>
<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: document.getElementById('total').innerText.replace('S/. ', '')  // Asegúrate de extraer solo el valor numérico
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            console.log('Pago realizado con éxito', details);
            // Aquí podrías redirigir al usuario a una página de éxito o actualizar tu base de datos.

            // Redirigir a la ruta de checkout en el servidor para generar el PDF
        window.location.href = "{{ route('cart.checkout') }}";
        });
    },
    onError: function(err) {
        // Manejo de errores
        console.error('Error en el pago con PayPal', err);
    }
}).render('#paypal-button-container');
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radioButtons = document.querySelectorAll('input[name="metodo_pago"]');
        const paypalContainer = document.getElementById('paypal-button-container');
        const payButton = document.querySelector('.pay-button');
    
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'paypal') {
                    paypalContainer.style.display = 'block';
                    payButton.style.display = 'none';
                } else {
                    paypalContainer.style.display = 'none';
                    payButton.style.display = 'block';
                }
            });
        });
    });
    </script>
    





    <script>
        function updateQuantity(id, change) {
    const quantityInput = document.getElementById(`quantity-${id}`);
    let quantity = parseInt(quantityInput.value);
    quantity += change;
    if (quantity < 1) quantity = 1; // Evitar cantidad menor a 1
    quantityInput.value = quantity;

    // Actualizar el campo oculto que se enviará en el formulario
    document.getElementById(`input-quantity-${id}`).value = quantity;

    // Obtener el precio del producto desde el atributo `data-price`
    const priceElement = document.getElementById(`price-${id}`);
    const price = parseFloat(priceElement.dataset.price);
    
    // Calcular el subtotal
    const subtotalElement = document.getElementById(`subtotal-${id}`);
    const subtotal = price * quantity;
    subtotalElement.innerText = subtotal.toFixed(2);

    // Actualizar el total general
    updateTotal();
}

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.product-select:checked').forEach(checkbox => {
                const id = checkbox.dataset.id;
                const subtotal = parseFloat(document.getElementById(`subtotal-${id}`).innerText);
                total += subtotal;
            });
            document.getElementById('total').innerText = total.toFixed(2);
        }

        document.querySelectorAll('.product-select').forEach(checkbox => {
            checkbox.addEventListener('change', updateTotal);
        });
    </script>
</body>
</html>

