

@extends('layouts.navbar')



@section('content')

<style>
    /* Estilo para el mensaje de bienvenida */
    .navbar-welcome {
        color: white; /* Color del texto */
        margin-right: 20px; /* Espacio a la derecha */
        font-weight: 600; /* Peso de la fuente */
    }

    /* Estilo para los enlaces de la navbar */
    .navbar-link {
        color: white; /* Color de los enlaces */
        text-decoration: none; /* Sin subrayado */
        margin-left: 20px; /* Espacio a la izquierda */
        font-weight: 600; /* Peso de la fuente */
        transition: color 0.3s; /* Transición para el efecto hover */
    }

    .navbar-link:hover {
        color: #18bc9c; /* Cambia el color al pasar el ratón */
    }
</style>



    <!-- Styles -->
    <style>
         /* Estilo global */
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c3e50;
            padding: 15px 30px;
            position: fixed;
            width: 100%;
            z-index: 100;
            transition: background-color 0.3s;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 600;
        }

        .navbar a:hover {
            color: #18bc9c;
        }

        .navbar-brand {
            font-size: 1.5em;
            font-weight: 700;
        }

        .navbar-menu {
            display: flex;
        }

        /* Media Queries para Navbar Responsivo */
        @media (max-width: 768px) {
            .navbar-menu {
                display: none;
                flex-direction: column;
            }

            .navbar.active .navbar-menu {
                display: flex;
            }

            .navbar-toggle {
                display: block;
                cursor: pointer;
            }
        }

        .navbar-toggle {
            display: none;
            color: white;
            font-size: 1.5em;
        }

        
        /* Animación */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Sección principal */
        .content {
            padding: 50px;
            text-align: center;
        }

        .card {
            display: inline-block;
            width: 300px;
            margin: 15px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }


        /* Estilo para el cuerpo principal */
.content {
    max-width: 1200px; /* Ancho máximo del contenido */
    margin: 20px auto; /* Centra el contenido en la página */
    padding: 20px; /* Espaciado interno */
    background-color: #ffffff; /* Fondo blanco para el contenido */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
    border-radius: 10px; /* Bordes redondeados */
}

/* Estilo para los encabezados */
.content h2 {
    font-size: 36px; /* Tamaño de fuente grande para los encabezados */
    color: #D2691E; /* Color para los encabezados */
    margin-bottom: 10px; /* Espacio debajo del encabezado */
    text-align: center; /* Centra el texto */
    text-transform: uppercase; /* Convierte el texto a mayúsculas */
    letter-spacing: 1px; /* Espaciado entre letras */
    border-bottom: 2px solid #D2691E; /* Línea debajo del encabezado */
    padding-bottom: 10px; /* Espacio debajo del texto */
}

/* Estilo para el párrafo */
.content p {
    font-size: 18px; /* Tamaño de fuente del párrafo */
    line-height: 1.6; /* Espaciado entre líneas */
    text-align: center; /* Centra el texto */
    margin-bottom: 30px; /* Espacio debajo del párrafo */
    color: #333; /* Color del texto */
}

/* Estilo para las tarjetas */
.card {
    background-color: #f9f9f9; /* Fondo claro para las tarjetas */
    border: 1px solid #ddd; /* Borde gris claro */
    border-radius: 8px; /* Bordes redondeados */
    padding: 20px; /* Espacio interno */
    margin: 15px 0; /* Espacio vertical entre tarjetas */
    transition: transform 0.3s, box-shadow 0.3s; /* Transición para efectos */
}

/* Efecto hover en las tarjetas */
.card:hover {
    transform: translateY(-5px); /* Eleva la tarjeta al pasar el ratón */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Sombra más pronunciada */
}

/* Estilo para los encabezados dentro de las tarjetas */
.card h3 {
    font-size: 24px; /* Tamaño de fuente para el título de la tarjeta */
    color: #D2691E; /* Color del título */
    margin-bottom: 10px; /* Espacio debajo del título */
}

/* Estilo para los párrafos dentro de las tarjetas */
.card p {
    font-size: 16px; /* Tamaño de fuente para el párrafo de la tarjeta */
    color: #555; /* Color del texto */
    line-height: 1.5; /* Espaciado entre líneas */
}






/* Estilo para el carrusel */
.carousel {
    position: relative; /* Posición relativa para los botones */
    overflow: hidden; /* Oculta las imágenes que salen del contenedor */
    max-width: 1000px; /* Ancho máximo del carrusel */
    margin: auto; /* Centra el carrusel */
    
    
}

.carousel-images {
    display: flex; /* Alinea las imágenes en línea */
    transition: transform 0.10s ease; /* Transición suave */
    width: 100%; /* Asegura que las imágenes ocupen todo el ancho */
    height: 2000%; /* Asegura que las imágenes ocupen toda la altura del contenedor */
    object-fit: cover; /* Mantiene la proporción de la imagen y la recorta si es necesario */
}

.carousel-images img {
    width: 200%; /* Asegura que las imágenes ocupen todo el ancho */
    height: 100%; /* Asegura que las imágenes ocupen toda la altura del contenedor */
    object-fit: cover; /* Mantiene la proporción de la imagen y la recorta si es necesario */
    border-radius: 5px; /* Bordes redondeados */
}



.carousel-images img {
    max-width: 100%; /* Asegura que las imágenes no se desborden */
    border-radius: 5px; /* Bordes redondeados */
}

.prev, .next {
    position: absolute; /* Posición absoluta para colocar los botones */
    top: 50%; /* Centra verticalmente */
    transform: translateY(-50%); /* Ajusta el centrado */
    background-color: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente */
    border: none; /* Elimina el borde */
    padding: 10px; /* Espaciado */
    cursor: pointer; /* Cambia el cursor a puntero */
    border-radius: 5px; /* Bordes redondeados */
}

.prev {
    left: 10px; /* Posición a la izquierda */
}

.next {
    right: 10px; /* Posición a la derecha */
}

.prev:hover, .next:hover {
    background-color: #FF5733; /* Color al pasar el mouse */
}


    </style>


</head>








<h1>hola</h1>
<section id="carrusel">

    <div class="carousel">
        <div class="carousel-images">
            <img src="https://media.istockphoto.com/id/1906630287/es/foto/process-of-creating-an-interface-for-a-mobile-app-user-interface-and-experience-concept-modern.jpg?s=2048x2048&w=is&k=20&c=l1e8Q3V1oh_TCc77VAF2yksKeEJb5zeSPaPh70kH89I=" alt="Proyecto 1">
            <img src="https://media.istockphoto.com/id/1385970223/es/foto/gran-idea-de-un-plan-de-estrategia-de-marketing-en-una-oficina-creativa.jpg?s=2048x2048&w=is&k=20&c=kKswEjvyz3apsOJLdeR4xh1N-4bHMd_2l5V5NxT8Tpw=" alt="Proyecto 2">
            <img src="https://media.istockphoto.com/id/1354583989/es/foto/joven-empresario-reflexivo-camisa-de-mezclilla-casual-sosteniendo-su-no.jpg?s=2048x2048&w=is&k=20&c=yQYYknQB7EVgKSErPtjaYcFn63qB7sJlGIECzWQhT5c=" alt="Proyecto 3">
        </div>
        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="next" onclick="moveSlide(1)">&#10095;</button>
    </div>
</section>

<body class="antialiased">
    <h1>Hola mundo</h1>

    <div class="container">
        <h1>Bienvenido a Nuestra Tienda</h1>
        <p>Encuentra los mejores productos al mejor precio.</p>
    </div>
    

<!-- Cuerpo principal -->
<div class="content">
<h2 id="nosotros">¿Quiénes Somos?</h2>
<p>Somos una empresa innovadora dedicada a crear soluciones digitales modernas.</p>

<h2 id="servicios">Nuestros Servicios</h2>
<div class="card">
    <h3>Desarrollo Web</h3>
    <p>Creamos sitios web personalizados con las últimas tecnologías.</p>
</div>
<div class="card">
    <h3>Marketing Digital</h3>
    <p>Impulsa tu marca con estrategias digitales efectivas.</p>
</div>
<div class="card">
    <h3>Consultoría IT</h3>
    <p>Te ayudamos a transformar tu negocio con tecnología.</p>
</div>
</div>

    
</body>

<script>
    let slideIndex = 0; // Índice del slide actual
    showSlides();

    function showSlides() {
        const slides = document.querySelectorAll('.carousel-images img');
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = 'none'; // Oculta todas las imágenes
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1} // Reinicia el índice si excede el número de imágenes
        slides[slideIndex - 1].style.display = 'block'; // Muestra la imagen actual
        setTimeout(showSlides, 3000); // Cambia de imagen cada 3 segundos
    }

    function moveSlide(n) {
        slideIndex += n;
        const slides = document.querySelectorAll('.carousel-images img');
        if (slideIndex > slides.length) {slideIndex = 1}
        if (slideIndex < 1) {slideIndex = slides.length}
        showSlidesManually(slides);
    }

    function showSlidesManually(slides) {
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = 'none'; // Oculta todas las imágenes
        }
        slides[slideIndex - 1].style.display = 'block'; // Muestra la imagen actual
    }
</script>
<!-- JavaScript para Navbar Responsive -->
<script>
    const toggle = document.querySelector('.navbar-toggle');
    const navbar = document.querySelector('.navbar');

    toggle.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });
</script>


@endsection