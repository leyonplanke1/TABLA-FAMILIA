

@extends('layouts.navbar')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros - La Familia</title>

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
            background-color: #f4f4f4;
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
            background-image: url('https://source.unsplash.com/1600x900/?teamwork');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black;
            text-align: center;
            padding: 20px;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 24px;
            max-width: 800px;
        }

        /* Sección Nosotros */
        .nosotros {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            text-align: center;
        }

        .nosotros h2 {
            font-size: 36px;
            color: #D2691E;
            margin-bottom: 20px;
        }

        .nosotros p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        /* Equipo */
        .team {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .team-member {
            background-color: white;
            padding: 20px;
            margin: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        .team-member img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .team-member h3 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .team-member p {
            font-size: 16px;
            color: #777;
        }

        /* Footer */
        footer {
            background-color: #D2691E;
            color: white;
            text-align: center;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    

    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1>Sobre Nosotros</h1>
            <p>Conoce más sobre nuestra historia, valores y lo que nos hace únicos.</p>
        </div>
    </div>

    <!-- Sección Nosotros -->
    <div class="nosotros" id="nosotros">
        <h2>¿Quiénes Somos?</h2>
        <p>
            En LA FAMILIA, nos dedicamos a brindar las mejores soluciones para nuestros clientes. 
            Creemos en la innovación, el trabajo en equipo y en crear un impacto positivo en la comunidad.
        </p>
    </div>

    <!-- Sección Equipo -->
    <div class="nosotros" id="equipo">
        <h2>Nuestro Equipo</h2>
        <div class="team">
            <div class="team-member">
                <img src="https://source.unsplash.com/100x100/?person" alt="Miembro 1">
                <h3>Juan Pérez</h3>
                <p>CEO & Fundador</p>
            </div>
            <div class="team-member">
                <img src="https://source.unsplash.com/100x100/?woman" alt="Miembro 2">
                <h3>María García</h3>
                <p>Directora de Marketing</p>
            </div>
            <div class="team-member">
                <img src="https://source.unsplash.com/100x100/?man" alt="Miembro 3">
                <h3>Pedro Fernández</h3>
                <p>Desarrollador Senior</p>
            </div>
        </div>
    </div>

   

</body>
</html>



@endsection