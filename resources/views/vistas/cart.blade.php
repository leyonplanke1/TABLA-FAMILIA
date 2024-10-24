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
    </style>
</head>

<div class="d-flex justify-content-start mt-3">
    <a href="{{ route('tienda.index') }}" class="btn btn-secondary">Regresar</a>
</div>



<body>
    <h1 style="text-align: center; margin-top: 20px;">Carrito de Compras</h1>

    <div class="container">
        @if(session('cart'))
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('cart') as $id => $producto)
                        <tr>
                            <td>{{ $producto['nombre'] }}</td>
                            <td>{{ $producto['cantidad'] ?? 1 }}</td> <!-- Si no existe, muestra 1 -->
                            <td>S/. {{ number_format($producto['precio'], 2) }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody> 
            </table>
        @else
            <p>No hay productos en el carrito.</p>
        @endif
    </div>
</body>
</html>
