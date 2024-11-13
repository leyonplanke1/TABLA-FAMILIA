@extends('layouts.app')

@section('content')

    <title>Historial de Ventas</title>
    <style>
        /* Estilos avanzados */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        h1 {
            text-align: center;
            font-size: 2rem;
            color: #333;
            margin-top: 20px;
        }

        .table-container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            color: #333;
        }

        table thead {
            background-color: #333;
            color: #fff;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 0.8rem;
            font-weight: bold;
            color: #fff;
            border-radius: 12px;
        }

        .badge.pendiente {
            background-color: #ff9800;
        }

        .badge.enviado {
            background-color: #4caf50;
        }

        /* Estilo del formulario de filtro */
        form {
            text-align: center;
            margin: 20px 0;
        }

        label {
            font-size: 1rem;
            margin-right: 8px;
            font-weight: bold;
            color: #333;
        }

        select {
            padding: 8px;
            font-size: 1rem;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-right: 8px;
        }

        button {
            padding: 8px 12px;
            font-size: 1rem;
            color: #fff;
            background-color: #333;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #555;
        }

        .print-button {
            background-color: #2196f3;
        }

        .print-button:hover {
            background-color: #0b7dda;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .table-container {
                width: 95%;
            }

            h1 {
                font-size: 1.5rem;
            }

            form label, form select, form button {
                font-size: 0.9rem;
            }
        }
    </style>

    <body>
        <h1>Historial de Ventas</h1>
        <form method="GET" action="{{ route('ventas.reporte') }}">
            <label for="filter">Filtrar Ventas:</label>
            <select name="filter" id="filter" onchange="updatePdfLink()">
                <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Ventas Totales</option>
                <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Ventas de Hoy</option>
            </select>
            <button type="submit">Ver Reporte</button>
            <a id="pdfButton" href="{{ route('ventas.pdf', ['filter' => 'all']) }}" class="btn btn-primary" download="true">Ver PDF</a>

        </form>
        

        <script>
            function updatePdfLink() {
                const filter = document.getElementById('filter').value;
                const pdfButton = document.getElementById('pdfButton');
                
                // Actualizar el enlace del botón de PDF según el filtro seleccionado
                pdfButton.href = `{{ route('ventas.pdf') }}?filter=${filter}`;
            }
            // Llama a `updatePdfLink` al cargar la página para asegurarte de que el enlace esté correcto
    window.onload = updatePdfLink;
        </script>
        


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

    
    
        

@endsection
