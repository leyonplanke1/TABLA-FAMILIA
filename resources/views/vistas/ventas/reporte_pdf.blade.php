<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style>
        /* Fuente personalizada */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f7f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Estilos de la tabla */
        .table-container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        thead {
            background-color: #4e73df;
            color: white;
            text-transform: uppercase;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            font-weight: 500;
            font-size: 13px;
            letter-spacing: 0.05em;
        }

        tr:nth-child(even) {
            background-color: #f4f7f9;
        }

        tr:hover {
            background-color: #e2e6ea;
            transition: background-color 0.3s ease;
        }

        td {
            color: #333;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 500;
            color: #fff;
            border-radius: 12px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .badge.pendiente {
            background-color: #f6c23e;
        }

        .badge.enviado {
            background-color: #1cc88a;
        }

        /* Botón para imprimir */
        .print-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4e73df;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }

        .print-btn:hover {
            background-color: #3a5fb0;
        }

        /* Estilos de impresión */
        @media print {
            body {
                background-color: white;
                color: black;
            }

            h1 {
                color: black;
            }

            table {
                box-shadow: none;
            }

            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <h1>Reporte de Ventas</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>SubTotal</th>
                    <th>Total Pagado</th>
                    <th>Fecha</th>
                    <th>Estado de Envío</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $venta->usuario ? $venta->usuario->nombre . ' ' . $venta->usuario->apellido : '' }}</td>
                        <td>S/ {{ number_format($venta->total, 2) }}</td>
                        <td>S/ {{ number_format($venta->pagoTotal, 2) }}</td>
                        <td>{{ $venta->fecha }}</td>
                        <td>
                            <span class="badge {{ $venta->estado_envio == 'pendiente' ? 'pendiente' : 'enviado' }}">
                                {{ ucfirst($venta->estado_envio) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
</body>
</html>
