
@extends('layouts.navbar')

@section('content')


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos - La Familia</title>

    <!-- Fuentes de Google -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- CSS Externo -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        /* Estilo Global */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Header */
        header {
            background-color: #D2691E;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 50px;
            margin-right: 10px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: 600;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        /* Hero Section */
        .hero {
            background-image: url('https://source.unsplash.com/1600x900/?contact');
            background-size: cover;
            background-position: center;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .hero h1 {
            font-size: 48px;
        }

        /* Sección de Contacto */
        .contact-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 50px;
            justify-content: center;
        }

        .contact-form, .contact-info {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-width: 300px;
        }

        .contact-form h2 {
            margin-bottom: 20px;
            color: #D2691E;
        }

        .contact-form input, 
        .contact-form textarea {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .contact-form button {
            background-color: #D2691E;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .contact-form button:hover {
            background-color: #FF5733;
        }

        /* Información de Contacto */
        .contact-info h2 {
            margin-bottom: 20px;
            color: #D2691E;
        }

        .contact-info p, .contact-info a {
            margin: 10px 0;
            font-size: 16px;
        }

        .contact-info a {
            color: #D2691E;
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            color: white;
            background-color: #FF5733;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .social-links a:hover {
            background-color: #D2691E;
        }

        /* FAQ Section */
        .faq-section {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .faq h2 {
            color: #D2691E;
            margin-bottom: 20px;
        }

        .faq-item {
            margin-bottom: 15px;
        }

        .faq-item h3 {
            cursor: pointer;
            margin-bottom: 5px;
        }

        .faq-item p {
            display: none;
            font-size: 16px;
        }

        /* Footer */
        footer {
            background-color: #D2691E;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 50px;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>

   

    <!-- Hero Section -->
    <div class="hero">
        <h1>Contáctanos</h1>
    </div>

    <!-- Sección de Contacto -->
    <div class="contact-container" id="contacto">
        <!-- Formulario de Contacto -->
        <div class="contact-form">
            <h2>Envíanos un Mensaje</h2>
            <form action="#" method="POST">
                <input type="text" name="nombre" placeholder="Tu Nombre" required>
                <input type="email" name="email" placeholder="Tu Correo Electrónico" required>
                <textarea name="mensaje" rows="5" placeholder="Tu Mensaje" required></textarea>
                <button type="submit">Enviar</button>
            </form>
        </div>

        <!-- Información de Contacto -->
        <div class="contact-info">
            <h2>Nuestra Información</h2>
            <p><strong>Teléfono:</strong> +51 987 654 321</p>
            <p><strong>Email:</strong> <a href="mailto:info@lafamilia.com">info@lafamilia.com</a></p>
            <p><strong>Dirección:</strong> Av. Principal 123, Lima, Perú</p>

            <div class="social-links">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- Sección FAQ -->
    <div class="faq-section">
        <h2>Preguntas Frecuentes (FAQ)</h2>
        <div class="faq">
            <div class="faq-item">
                <h3>¿Cuál es nuestro horario de atención?</h3>
                <p>Atendemos de lunes a viernes de 8:00 AM a 6:00 PM.</p>
            </div>
            <div class="faq-item">
                <h3>¿Dónde estamos ubicados?</h3>
                <p>Nuestra oficina se encuentra en Lima, Perú.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    

    <script>
        // JavaScript para desplegar las FAQ
        document.querySelectorAll('.faq-item h3').forEach(item => {
            item.addEventListener('click', () => {
                const answer = item.nextElementSibling;
                answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>

</body>
</html>

          
@endsection