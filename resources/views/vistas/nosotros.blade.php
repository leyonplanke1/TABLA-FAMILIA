

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

        
        .title {
    font-size: 2.2rem; /* Ajusta el tamaño del título si es necesario */
    color: #003366;
    margin-bottom: 50px; /* Añade un espacio adicional debajo del título */
    text-align: center;
    font-weight: bold;
}

.mision h3, .vision h3 {
    font-size: 2rem;
    color: #003366;
    margin-bottom: 25px; /* Aumenta el espacio debajo de los títulos de Misión y Visión */
    border-bottom: 3px solid #FF5733;
    display: inline-block;
    padding-bottom: 5px;
}

body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}

/* Header */
header {
    background-color: #D2691E;
    padding: 5px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    transition: background-color 0.3s ease;
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
    transition: color 0.3s;
}

.navbar a:hover {
    text-decoration: underline;
    color: #FF5733;
}

/* Hero Section */
.hero {
    background-image: url('https://source.unsplash.com/1600x900/?teamwork');
    background-size: cover;
    background-position: center;
    height: 500px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.hero h1 {
    font-size: 4rem;
    margin-bottom: 10px;
    text-transform: uppercase;
    font-weight: 700;
}

.hero p {
    font-size: 1.6rem;
    max-width: 900px;
    margin: 0 auto;
}

/* Sección Nosotros */
.nosotros {
    max-width: 1200px;
    margin: 80px auto;
    padding: 30px;
    text-align: center;
}

.titulo-nosotros {
    font-size: 2.5rem;
    color: #D2691E;
    margin-bottom: 60px; /* Reduce el espacio de separación entre el título y el texto */
    text-transform: uppercase;
    font-weight: 700; /* Ajusta el peso del texto para que se vea más equilibrado */
    letter-spacing: 2px; /* Espaciado entre las letras para mejor legibilidad */
    text-align: center; /* Centra el título */
    animation: fadeIn 1s ease-out; /* Animación para que aparezca de forma suave */
    padding-top: 50px; /* Agrega espacio arriba del título */
    margin-bottom: 60px;
}

/* Animación */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.descripcion-nosotros {
    font-size: 1.2rem;
    color: #333;
    line-height: 1.8;
    margin-top: 40px;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
    text-align: justify;
    padding:0 20px; /* Agrega un padding de 20px para dar espacio de los bordes */
}

/* Equipo */
.nosotros-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 30px;
    margin-bottom: 50px;
    animation: slideUp 1s ease-out;
    padding-right: 10%
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
    border-radius: 12px;
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
}

.nosotros-imagen img:hover {
    transform: scale(1.05);
}

/* Misión y Visión */
.mision-vision {
    display: flex;
    justify-content: space-around;
    margin-top: 30px;
    text-align: center;
    gap: 30px;
}

.mision, .vision {
    width: 40%;
}

.mision h3, .vision h3 {
    font-size: 2rem;
    color: #003366;
    margin-bottom: 15px;
    border-bottom: 3px solid #FF5733;
    display: inline-block;
    padding-bottom: 5px;
}

.mision p, .vision p {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #555;
}

/* Footer */
footer {
    background-color: #D2691E;
    color: white;
    text-align: center;
    padding: 20px;
    position: relative;
    bottom: 0;
    width: 100%;
    box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
}

/* Media Query para pantallas pequeñas */
@media (max-width: 768px) {
    .nosotros-container {
        flex-direction: column;
        text-align: center;
    }

    .nosotros-texto {
        max-width: 100%;
        padding: 10%;
    }

    .mision-vision {
        flex-direction: column;
    }
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
            En LA FAMILIA, somos un grupo de personas dedicadas a ofrecer productos de calidad para nuestros clientes. Sabemos lo importante que es tener confianza al elegir un buen producto, por eso nos aseguramos de que todo lo que ofrecemos cumpla con los más altos estándares, siempre con el objetivo de satisfacer tus necesidades.

Nuestra misión es innovar constantemente, trabajar en equipo y generar un impacto positivo en la comunidad. Llevamos tiempo en este camino y estamos comprometidos con seguir mejorando, siempre buscando ofrecer lo mejor en productos y servicios.

Para nosotros, lo más importante es la colaboración y el esfuerzo conjunto, tanto con nuestros clientes como con nuestros colaboradores. Nos sentimos orgullosos de ser parte de un proyecto que busca mejorar la vida de las personas a través de lo que hacemos, brindando productos de calidad, atención cercana y confiable.

En LA FAMILIA, nos importa mucho que te sientas bien con tu compra y con todo lo que hacemos por ti.
        </p>
    </div>
</section>
 

    <section id="nosotros" class="nosotros">
        
        <h2 class="title">En Nuestras Propias Palabras</h2>

        <div class="nosotros-container">
            <div class="nosotros-texto">
                <h3>¡El esfuerzo de lograr un servicio óptimo!</h3>
                <p>En La Familia, nos apasiona ofrecer productos de alta calidad y brindar un excelente servicio a todos nuestros clientes. Sabemos que elegir productos adecuados es importante, por eso, nos aseguramos de que cada uno de nuestros artículos cumpla con los más altos estándares de calidad. Lo más importante para nosotros es la confianza de nuestros clientes.</p>
                <p>Nuestra misión es estar siempre innovando, trabajando como un equipo comprometido y generando un impacto positivo en la comunidad. Contamos con un equipo altamente capacitado, y trabajamos cada día para mejorar y ofrecer lo mejor en productos y atención al cliente.</p>
                <p>Nuestro equipo sigue el desafío de mantener un servicio excelente, innovador, y altamente confiable, brindando siempre la mejor atención y productos de calidad. Nos sentimos orgullosos de ser una empresa que mejora la vida de las personas a través de lo que hacemos.</p>
                <p><strong>Equipo La Familia</strong><br>Gerencia</p>
            </div>
            <div class="nosotros-imagen">
                <img src="https://i.pinimg.com/736x/50/bb/7b/50bb7b0de349c8fd5f6d893e46ad6ef8.jpg" width="500x" height="500x">
            </div>
        </div>
    
        <div class="mision-vision">
            <div class="mision">
                <h3>Misión</h3>
                <p>Nuestra misión es ofrecer una experiencia de compra integral, combinando calidad, eficiencia y accesibilidad mediante un sistema moderno de ventas e inventarios. En "La Familia", nos comprometemos a ser aliados de nuestros clientes, brindando productos accesibles y un servicio confiable que mejore su vida diaria.
                </p>
            </div>
            <div class="vision">
                <h3>Visión</h3>
                <p>Nuestra visión es liderar en ventas , destacándonos por la excelencia en productos y atención al cliente. Buscamos ofrecer soluciones prácticas y experiencias de compra personalizadas, promoviendo un crecimiento sostenible y una sólida presencia en el mercado, con enfoque en la satisfacción del cliente y el desarrollo constante.
                </p>
            </div>
        </div>
    </section>
    

</body>
</html>



@endsection