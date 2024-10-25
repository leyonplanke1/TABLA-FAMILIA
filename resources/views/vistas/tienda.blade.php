
@extends('layouts.navbar')
@section('title', 'Tienda Virtual - La Familia')
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
    
        .tienda-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 20px; /* Aumentamos el padding para evitar superposiciones */
        text-align: center; /* Centramos el contenido */
    }
    
        .title {
            text-align: center;
            font-size: 3rem; /* Tamaño del texto aumentado */
            margin-bottom: 40px;
            font-weight: bold;
            color: #D2691E; /* Color llamativo */
        }
    
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
    
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
    
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
    
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    
        .card-body {
            padding: 15px;
        }
    
        .product-title {
            font-size: 1.5rem;
            margin: 10px 0;
            color: #333;
        }
    
        .product-price {
            color: #FF5733;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
    
        .product-quantity {
            margin-bottom: 10px;
        }
    
        .btn-add-cart {
            background-color: #FF5733;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
    
        .btn-add-cart:hover {
            background-color: #D2691E;
        }
    </style>
    
    <div class="tienda-container">
        <h1 class="title">Explora Nuestra Tienda</h1> <!-- Aquí está el título -->
    
        <div class="product-grid">
            @foreach ($productos as $producto)
            <div class="card">
                <img src="{{ asset('images/' . $producto->foto) }}" alt="{{ $producto->nombre }}" class="product-img">
                <div class="card-body">
                    <h3 class="product-title">{{ $producto->nombre }}</h3>
                    <p class="product-price">S/. {{ number_format($producto->precio, 2) }}</p>
    
                    <select class="product-quantity" data-id_producto="{{ $producto->id_producto }}">
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
    
                    <button class="btn-add-cart" data-id_producto="{{ $producto->id_producto }}">
                        Agregar al Carrito
                    </button>
                </div>
            </div>
            @endforeach
        </div>
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