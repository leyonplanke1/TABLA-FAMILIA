<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago Exitoso</title>
    <style>
        /* Estilo global de la página */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #74EBD5 0%, #9FACE6 100%);
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        /* Estilo del contenedor principal */
        .container {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            text-align: center;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.6s ease-in-out;
        }

        /* Título principal */
        h1 {
            font-size: 28px;
            color: #4CAF50;
            margin-bottom: 20px;
            font-weight: bold;
            animation: slideInFromTop 0.6s ease-in-out;
        }

        /* Mensaje de confirmación */
        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }

        /* Estilo de los botones */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 4px;
            text-decoration: none;
            margin: 10px;
            transition: background 0.3s ease, transform 0.2s;
        }

        /* Botón "Abrir Recibo en Nueva Pestaña" */
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Botón "Regresar a la Tienda" */
        .btn-secondary {
            background-color: #f44336;
            color: #fff;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #d32f2f;
            transform: scale(1.05);
        }

        /* Animación de entrada */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInFromTop {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pago realizado con éxito</h1>
        <p>Tu recibo está listo. Puedes abrirlo en una nueva pestaña.</p>
        <a href="{{ $pdfUrl }}" target="_blank" class="btn btn-primary">Abrir Recibo en Nueva Pestaña</a>
        <a href="{{ route('tienda.index') }}" class="btn btn-secondary">Regresar a la Tienda</a>
    </div>
</body>
</html>
