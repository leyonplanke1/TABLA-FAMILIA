

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
            padding: 5px 15px;
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
        .nosotros {
    padding: 50px;
    background-color: #f4f4f4;
}

.title {
    text-align: center;
    font-size: 2.5rem;
    color: #003366;
    margin-bottom: 30px;
}

.nosotros-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 50px;
}

.nosotros-texto {
    flex: 1;
    max-width: 60%;
    font-size: 1.1rem;
    line-height: 1.6;
    color: #333;
}

.nosotros-imagen img {
    max-width: 100%;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

.mision-vision {
    display: flex;
    justify-content: space-around;
    margin-top: 30px;
    text-align: center;
}

.mision, .vision {
    width: 40%;
}

.mision h3, .vision h3 {
    font-size: 1.8rem;
    color: #003366;
    margin-bottom: 10px;
    border-bottom: 3px solid #28a745;
    display: inline-block;
    padding-bottom: 5px;
}

.mision p, .vision p {
    font-size: 1rem;
    line-height: 1.5;
    color: #555;
}

.nosotros {
    padding: 110px;
    background-color: #f4f4f4;
    text-align: center;
    margin-top: 0px;
}

.contenedor-nosotros {
    max-width: 900px;
    margin: 20px auto;
}

.titulo-nosotros {
    font-size: 2.5rem;
    color: #D2691E; /* Ajusta el color si es necesario */
    margin-bottom: 50px;
    text-transform: uppercase;
    font-weight: bold;
}

.descripcion-nosotros {
    font-size: 1.2rem;
    color: #333;
    line-height: 1.6;
    margin-top: 100px;
}





    </style>
</head>

<body>

    

    

    <!-- Sección Nosotros -->
    <!-- Sección Nosotros -->
<section class="nosotros" id="nosotros">
    <div class="contenedor-nosotros">
        <h2 class="titulo-nosotros">¿Quiénes Somos?</h2>
        <p class="descripcion-nosotros">
            En LA FAMILIA, nos dedicamos a brindar las mejores soluciones para nuestros clientes. 
            Creemos en la innovación, el trabajo en equipo y en crear un impacto positivo en la comunidad.
        </p>
    </div>
</section>
 

    <section id="nosotros" class="nosotros">
        <h2 class="title">En Nuestras Propias Palabras</h2>
        <div class="nosotros-container">
            <div class="nosotros-texto">
                <h3>¡El esfuerzo de lograr un servicio óptimo!</h3>
                <p>En nuestra empresa tenemos los objetivos claros, para así fortalecer nuestra organización, contando con personal altamente capacitado y comprometido, basada en la rapidez en la atención al cliente y la buena calidad de los productos.</p>
                <p>Hoy en día, contamos con la capacidad de ofrecer a nuestros clientes una variedad de Gases Industriales y Medicinales, Extintores, Seguridad Industrial, Soldadura, entre otros productos especializados de la demanda en el mercado.</p>
                <p>Mantenemos el reto continuo de mantener un personal altamente motivado y capacitado; como recursos, productos de reconocida calidad; y sobre todo la satisfacción de contar día a día con clientes satisfechos a quienes damos la bienvenida y recibimos como parte de esta gran familia.</p>
                <p><strong>Equipo La Familia</strong><br>Gerencia</p>
            </div>
            <div class="nosotros-imagen">
                <img src="https://files.oaiusercontent.com/file-FKLL1AwE7sgmJ9Cb3k2gWdLw?se=2024-11-08T03%3A54%3A36Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3Da2283fda-2024-441b-a7a9-7018de387261.webp&sig=9QnYxpDG/P4NlvNr7LstEurUfkdoWr6CmovXDlX91/Q%3D" alt="Equipo La Familia" width="500x" height="500x">
            </div>
        </div>
    
        <div class="mision-vision">
            <div class="mision">
                <h3>Misión</h3>
                <p>Nuestra misión consiste en alcanzar el éxito basándonos en la dedicación a la satisfacción del cliente, innovación constante y eficiencia operativa.</p>
            </div>
            <div class="vision">
                <h3>Visión</h3>
                <p>Ser reconocidos como líderes en nuestro sector, otorgando soluciones que excedan las expectativas de nuestros clientes.</p>
            </div>
        </div>
    </section>
    

</body>
</html>



@endsection