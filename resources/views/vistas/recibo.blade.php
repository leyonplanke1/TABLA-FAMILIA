<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $tituloDocumento }}</title>
    <style>
        /* Estilos avanzados */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #f8f8f8;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            margin-bottom: 10px;
        }
        h1 {
            color: #D2691E;
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }
        .info-cliente {
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .info-cliente h2 {
            font-size: 18px;
            color: #D2691E;
            margin-bottom: 10px;
        }
        .info-cliente p {
            margin: 5px 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
        .total .label {
            padding-right: 10px;
        }
        .total-separator {
            border-top: 2px solid #333;
            padding-top: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('path/to/logo.png') }}" alt="Logo La Familia">
        <h1>{{ $tituloDocumento }}</h1>
    </div>

    <div class="info-cliente">
        <h2>Información del Cliente</h2>
        <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
        <p><strong>Dirección de Envío:</strong> {{ $direccion }}</p>
        <p><strong>Método de Envío:</strong> {{ $metodoEnvio }}</p>
        <p><strong>Costo de Envío :</strong> S/. {{ number_format($costoEnvio, 2) }}</p>
        <p><strong>Método de Pago:</strong> {{ $metodoPago }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
                <tr>
                    <td>{{ $item['nombre'] }}</td>
                    <td>{{ $item['cantidad'] }}</td>
                    <td>S/. {{ number_format($item['precio_con_igv'], 2) }}</td>
                    <td>S/. {{ number_format($item['precio_con_igv'] * $item['cantidad'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p>Subtotal: S/. {{ number_format($subtotal, 2) }}</p>
        <p>Costo de Envío: S/. {{ number_format($costoEnvio, 2) }}</p>
        <div class="total-separator">
            
            <p>Total a pagar: S/. {{ number_format($subtotal+$costoEnvio, 2) }}</p>
        </div>
    </div>
</body>
</html>
