
@extends('layouts.navbar')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda - La Familia</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            text-align: center;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card h3 {
            margin: 10px 0;
        }

        .card p {
            color: #D2691E;
            font-size: 18px;
        }

        .btn {
            background-color: #FF5733;
            color: white;
            padding: 10px;
            text-decoration: none;
            display: block;
            margin: 10px 0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #D2691E;
        }
    </style>
</head>




<div class="container">
    @foreach ($productos as $producto)
        <div class="card">
            <img src="{{ asset('images/' . $producto->foto) }}" alt="{{ $producto->nombre }}">
            <h3>{{ $producto->nombre }}</h3>
            <p>S/. {{ number_format($producto->precio, 2) }}</p>

            <!-- Select para seleccionar la cantidad -->
            <select class="product-quantity" data-id_producto="{{ $producto->id_producto }}">
                @for ($i = 1; $i <= 10; $i++) <!-- Máximo 10 unidades -->
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <button class="btn-add-cart" data-id_producto="{{ $producto->id_producto }}">
                Agregar al Carrito
            </button>
        </div>
    @endforeach
</div>



    
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Escuchar clics en los botones de "Agregar al Carrito"
        $('.btn-add-cart').on('click', function () {
            var productId = $(this).data('id_producto'); // Obtener ID del producto
            var quantity = $(this).siblings('.product-quantity').val(); // Obtener cantidad seleccionada

            $.ajax({
                url: "{{ url('/cart/add') }}/" + productId, // Ruta del controlador
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_producto: productId,
                    cantidad: quantity // Enviar cantidad seleccionada
                },
                success: function (response) {
                    $('#cart-count').text(response.cartCount); // Actualiza el contador
                    alert('Producto agregado al carrito.');
                },
                error: function () {
                    alert('Tienes que iniciar secion para continuar..');
                    window.location.href = "{{ route('login') }}";
                }
            });
        });
    });
</script>



</script>




@endsection