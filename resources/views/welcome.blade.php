

@extends('layouts.navbar')



@section('content')


 {{-- Incluir la barra de navegación y pasar las categorías --}}


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
    position: relative;
    width: 100%; /* Se ajusta al ancho del contenedor */
    max-width: 1000px; /* Ancho máximo del carrusel */
    margin: 20px auto;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.carousel-images {
    display: flex;
    transition: transform 0.5s ease;
}

.carousel-images img {
    width: 2000px;  /* Controla el ancho de las imágenes */
    height: 750px; /* Controla la altura de las imágenes */
    object-fit: cover; /* Asegura que las imágenes mantengan sus proporciones */
    margin: 10px; /* Espacio entre las imágenes */
    border-radius: 20px; /* Esquinas redondeadas */
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


.product-section {
    display: flex;
    justify-content: center;
    gap: 50px;
    margin: 60px auto;
    max-width: 1400px;
}

.product-card {
    text-align: center;
    max-width: 900px; /* Ajusta el ancho de la tarjeta */
}

.product-card img {
    width: 100%;  /* Asegura que la imagen ocupe el ancho completo de la tarjeta */
    height: 600px; /* Incrementa la altura de la imagen */
    object-fit: cover;
    border-radius: 15px;
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1); /* Sombra más suave */
    transition: transform 0.3s; /* Animación suave al pasar el cursor */
}

.product-card img:hover {
    transform: scale(1.05); /* Efecto zoom al pasar el cursor */
}

.product-card h2 {
    color: #2C3E50;
    margin: 15px 0;
    font-size: 1.5rem; /* Tamaño más grande para los títulos */
    font-weight: 500;
}

.product-card h3 {
    color: #D2691E;
    font-weight: bold;
    margin-bottom: 25px;
    font-size: 1.2rem; /* Tamaño más grande para los subtítulos */
}

.extintores-section {
    display: flex;
    align-items: center;
    padding: 50px;
    background-color: #f4f4f4;
    border-radius: 15px;
    margin-bottom: 40px;
}

.extintores-content {
    display: flex;
    align-items: center;
    gap: 20px;
}

.extintores-img {
    width: 50%;
    border-radius: 10px;
}

.extintores-info {
    max-width: 50%;
}

.extintores-info h1 {
    color: #D2691E;
}

.btn-comprar {
    background-color: #D2691E;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.productos-recomendados {
    text-align: center;
    margin-top: 30px;
}

.productos-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    padding: 20px;
}

.producto-card {
    background-color: white;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.producto-card img {
    width: 100%;
    border-radius: 10px;
}




    </style>


</head>








<h1>hola</h1>
<section id="carrusel">

    <div class="carousel">
        <div class="carousel-images">
            <img src="https://files.oaiusercontent.com/file-s4XagS8jiUVWcV5DPr8H9LiL?se=2024-10-25T01%3A24%3A05Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3Ddb048eb1-508f-4bbe-8b5b-3d4795f7695f.webp&sig=oG83BLcCHGvuPih9Sq9rsCeWUVqcK6qxHIF3NdJrUYg%3D" alt="Proyecto 1">
            <img src="https://files.oaiusercontent.com/file-YCqabcULX3WJx6L99BdVNLDL?se=2024-10-25T01%3A27%3A47Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D8d098f09-c22b-4e2d-b408-9c0072ab1852.webp&sig=3bQoJ3QGybcqkMaEEP0Y3GT3IU%2BUw0RjLauH%2Bg5rjYs%3D" alt="Proyecto 2">
            <img src="https://files.oaiusercontent.com/file-Eqq4Ujqo0954kSl1ZiooTIlM?se=2024-10-25T01%3A25%3A34Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D4fef244c-5db2-4d81-b7b1-b7a22674dadd.webp&sig=Gg2bTMz9oN0BGKWEkIS97sdxVZV1Sp7kvUvNPz1IiMo%3D" alt="Proyecto 3" width="50px" height="90px">
        </div>
        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="next" onclick="moveSlide(1)">&#10095;</button>
    </div>
</section>





<body class="antialiased">
    <

    
    <div class="product-section">
        <div class="product-card">
            <img src="{{ asset('images/lana2.jpg') }}" alt="Gases Medicinales" width="20px">
            <h2>Lanas de toda calidad</h2>
            <h3>Todas las marcas</h3>
        </div>
    
        <div class="product-card">
            <img src="{{ asset('images/boto.jpg') }}" alt="Gases Industriales">
            <h2>Merceria en General</h2>
            <h3>Todas las calidades</h3>
        </div>
    
        <div class="product-card">
            <img src="{{ asset('images/tela.jpg') }}" alt="Accesorios">
            <h2>Telas </h2>
            <h3>Todos los materiales</h3>
        </div>
        <div class="product-card">
            <img src="{{ asset('images/mochila.jpg') }}" alt="Accesorios">
            <h2>Mochilas y Carteras  </h2>
            <h3>Todas las calidades</h3>
        </div>
    </div>
    </div>
    

    <div class="extintores-section">
        <div class="extintores-content">
            <img src="https://files.oaiusercontent.com/file-VZoV1fxEmAXsdjr0SzoUY1uK?se=2024-10-25T01%3A31%3A43Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3Da018e1c8-b5d6-49ed-be51-eeae5de19e42.webp&sig=mJQY1ptUT9AzMwQWr%2BJfaZHVzaOeAQRhuwyHm8/Eo1k%3D" alt="Extintores" class="extintores-img">
            <div class="extintores-info">
                <h2>Calidad en merceria</h2>
                <h1>Siempre La mejor Calidad</h1>
                <p>
                    Compartimos la mejor calidad a traves de nuestro producto y el mejor servicio a disposicion de todo publico.
                </p>
                <button class="btn-comprar">COMPRAR AHORA</button>
            </div>
        </div>
    </div>
    
    <div class="productos-recomendados">
        <h1>Nuestros Productos Recomendados</h1>
        <div class="productos-grid">
            <div class="producto-card">
                <img src="https://i.pinimg.com/564x/4f/2f/35/4f2f352dfdcd51ac754946de1603dd0a.jpg" alt="Oxígeno JD/JP">
                <p>Lanas de Toda Calidad</p>
            </div>
            <div class="producto-card">
                <img src="https://i.pinimg.com/564x/75/4e/39/754e3958c97ec49b41b9abbffd711495.jpg" alt="Oxígeno NORRIS">
                <p>Ropa interior  niños y adultos</p>
            </div>
            <div class="producto-card">
                <img src="https://i.pinimg.com/564x/8e/df/c4/8edfc4abcf8dfad7f8cb30bdd36fb2b9.jpg" alt="Oxígeno 1.5 M3">
                <p>Telas de toda calidades</p>
            </div>
            <div class="producto-card">
                <img src="https://i.pinimg.com/564x/a4/8b/f2/a48bf23f6c28a229a6640986349db995.jpg" alt="Oxígeno Portátil">
                <p>Mochilas y Carteras</p>
            </div>
        </div>
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