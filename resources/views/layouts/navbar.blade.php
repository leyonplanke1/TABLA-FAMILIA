<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LA FAMILIA</title>

    <!-- Fuentes de Google -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">

    <!-- CSS externo -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (Opcional si lo usas) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

   
    <meta name="csrf-token" content="{{ csrf_token() }}">


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

        /* Header/Navbar */
        header {
    background-color: #D2691E;
    padding: 5px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    position: fixed; /* Fijar en la parte superior */
    top: 0; /* Asegura que esté en la parte superior */
    width: 100%; /* Ocupar todo el ancho */
    z-index: 100; /* Asegurar que quede sobre otros elementos */
}

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo {
            height: 50px;
            transition: transform 0.3s ease-in-out;
        }

        .logo:hover {
            transform: scale(1.1);
        }

        .brand-name {
            color: #FFF8DC;
            font-size: 36px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .navbar-menu {
            display: flex;
            gap: 20px;
        }

        .navbar-menu a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .navbar-menu a:hover {
            background-color: #FF5733;
            color: white;
        }

        .navbar-search {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .navbar-search input {
            padding: 10px 20px;
            border-radius: 20px;
            border: 1px solid #ccc;
        }

        .navbar-search button {
            background-color: #FF5733;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
        }

        .navbar-icons {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .login-btn, .register-btn {
            background-color: #FF5733;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-btn:hover, .register-btn:hover {
            background-color: #D2691E;
        }
/*--------------------------------------------------------------------*/
        /* Icono del carrito */
.cart-icon {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50px;
    height: 50px;
    background-color: #FF5733;
    border-radius: 50%;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.cart-icon:hover {
    background-color: #C70039;
    transform: scale(1.1);
}

/* Estilo del contador del carrito */
.cart-count {
    position: absolute;
    top: -5px;
    right: -10px;
    background-color: red;
    color: white;
    font-size: 14px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
}


/*--------------------------------------------------------------------*/



        .footer {
            background-color: #D2691E;
            color: white;
            text-align: center;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer p {
            margin: 0;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .footer p:hover {
            color: white;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        @media (max-width: 768px) {
            .navbar-menu {
                display: block;
                flex-direction: column;
                position: absolute;
                top: 60px;
                right: 0;
                width: 100%;
                background-color: #34495E;
                text-align: center;
            }

            .navbar-menu a {
                border-bottom: 1px solid #ecf0f1;
            }

            .navbar-toggle {
                display: block;
                color: white;
                font-size: 1.5em;
            }

            .navbar.active .navbar-menu {
                display: flex;
            }
    }
            /* Estilo para el mensaje de bienvenida */
    .navbar-welcome {
        color: white; /* Color del texto */
        margin-right: 20px; /* Espacio a la derecha */
        font-weight: 600; /* Peso de la fuente */
    }

    /* Estilo para los enlaces de la navbar */
    .login-btn, .register-btn, .logout-btn {
        background-color: #B8860B; /* Color de fondo */
        color: white; /* Color del texto */
        border: none; /* Sin borde */
        padding: 15px 20px; /* Espaciado interno */
        border-radius: 10px; /* Bordes redondeados */
        cursor: pointer; /* Cambia el cursor a puntero */
        transition: background-color 0.3s; /* Transición para el efecto hover */
        margin-left: -10px; /* Espacio entre botones */
    }

    .login-btn:hover, .register-btn:hover, .logout-btn:hover {
        background-color: #B8860B; /* Cambia el color al pasar el ratón */
        margin-left: -10px; /* Espacio entre botones */
    }

    .navbar-search {
    display: flex;
    align-items: center;
    gap: 5px;
}

.navbar-search input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px 0 0 5px;
    width: 300px;
    outline: none;
}

.navbar-search button {
    padding: 10px;
    background-color: #ff5733;
    color: white;
    border: none;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
}

.navbar-search button:hover {
    background-color: #d2691e;
}

.navbar-search i {
    font-size: 18px;
}

.page-content {
    margin-top: 80px; /* Ajusta este valor según la altura del header */
}

#categoriasMenu {
    background-color: #D2691E;
    border-radius: 8px;
    margin-top: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.list-group-item a {
    text-decoration: none;
    color: #333;
}

.list-group-item a:hover {
    color: #d2691e;
    font-weight: bold;
}
/* Contenedor del dropdown */
.dropdown.avanzado {
    position: relative;
    display: inline-block;
}

/* Menú desplegable oculto por defecto */
.dropdown-menu {
    display: block;
    visibility: hidden;
    opacity: 0;
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 200px;
    background-color: white;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 10px 0;
    transform: translateY(-10px);
    transition: all 0.3s ease-in-out;
    z-index: 1050;
}

/* Mostrar el menú al hacer hover sobre el contenedor */
.dropdown.avanzado:hover .dropdown-menu {
    visibility: visible;
    opacity: 1;
    transform: translateY(0);
}

/* Estilo para los enlaces del menú */
.dropdown-item {
    padding: 10px 20px;
    color: #333;
    text-decoration: none;
    font-size: 16px;
    transition: background-color 0.2s ease, color 0.2s ease;
}

/* Efecto hover sobre cada opción */
.dropdown-item:hover {
    background-color: #FF5733;
    color: black;
    border-radius: 5px;
}

/* Estilo del botón principal */
#dropdownTienda {
    background-color: #D2691E;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

#dropdownTienda:hover {
    background-color: #2C3E50;
    transform: scale(1.05);
}


        /* Estilos Globales */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    padding-top: 60px; /* Añade espacio para el header fijo */
}

/* Estilos para la Navbar */
header {
    background-color: #D2691E;
    padding: 5px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 100;
}

.navbar-menu {
    display: flex;
    gap: 20px;
}

.navbar-menu a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.navbar-menu a:hover {
    background-color: #FF5733;
    color: white;
}

/* Estilos para dispositivos móviles */
@media (max-width: 768px) {
    /* Ajuste del logo y título */
    .navbar-brand {
        flex-direction: column;
        gap: 5px;
        text-align: center;
    }

    /* Menú hamburguesa para dispositivos móviles */
    .navbar-menu {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 60px;
        right: 0;
        width: 100%;
        background-color: #D2691E;
        text-align: center;
        z-index: 99;
    }

    .navbar-menu a {
        padding: 15px 10;
        border-bottom: 1px solid #FF5733;
        
    }

    /* Botón de menú hamburguesa */
    .hamburger {
        display: block;
        background: none;
        border: none;
        font-size: 1.8rem;
        color: white;
        cursor: pointer;
    }

    /* Mostrar menú al hacer clic en el botón */
    .navbar-menu.active {
        display: flex;
    }

    /* Ocultar barra de búsqueda y otros íconos en móviles */
    .navbar-search,
    .cart-icon,
    .navbar-welcome,
    .login-btn,
    .register-btn,
    .logout-btn {
        display: none;
    }
}

/* Ajustes adicionales para pantallas pequeñas */
@media (max-width: 480px) {
    /* Tamaños de fuentes y botones más pequeños */
    .brand-name {
        font-size: 1.5rem;
    }

    .navbar-menu a {
        font-size: 1rem;
        padding: 10px 0;
    }

    .cart-count {
        font-size: 12px;
        width: 18px;
        height: 18px;
    }

    /* Ajuste del tamaño de los íconos */
    .cart-icon {
        width: 40px;
        height: 40px;
    }
}


@media (min-width: 769px) {
    #show-hide-sidebar-toggle, .hamburger {
        display: none;
    }
}


/* Estilo de los botones de inicio de sesión y registro en dispositivos móviles */
.login-btn, .register-btn {
    display: block;
    background-color: #B8860B; /* Color de fondo */
    color: white; /* Color del texto */
    border: none;
    padding: 10px 15px;
    margin: 10px 0; /* Espacio entre los botones */
    border-radius: 5px;
    text-align: center;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.login-btn:hover, .register-btn:hover {
    background-color: #D2691E; /* Color de fondo al pasar el cursor */
}

/* Asegurarse de que los botones sean visibles en el menú móvil */
@media (max-width: 768px) {
    .login-btn, .register-btn {
        color: white !important; /* Asegura que el texto sea blanco */
        display: inline-block; /* Asegura que se muestren en línea en el menú */
    }
}


    </style>





<title>
    @yield('titulo', "inicio")
</title>







</head>

<body>



    
    <!-- Header/Navbar -->
    <header>
        <div class="navbar-brand">
            <img src="{{ asset('img-inicio/familia.png') }}" alt="Logo LA FAMILIA" class="logo img-fluid">

            <span class="brand-name">LA FAMILIA</span>
        </div>

         <!-- Botón de menú hamburguesa para móviles -->
    <button class="hamburger">&#9776;</button>

        <div class="navbar-menu">
            <a href="http://localhost/sistema-lafamilia/TABLA-FAMILIA/public/welcome">Inicio</a>
            <a href="http://localhost/sistema-lafamilia/TABLA-FAMILIA/public/nosotros">Nosotros</a>
            <a href="http://localhost/sistema-lafamilia/TABLA-FAMILIA/public/contacto">Contáctanos</a>
             <!-- Menú desplegable para Tienda Virtual -->
    
    
    
             <div class="dropdown avanzado">
                <button class="btn btn-secondary dropdown-toggle" id="dropdownTienda">
                    Tienda Virtual
                </button>
        
                <div class="dropdown-menu" id="categoriasMenu">
                    @foreach($categorias as $categoria)
                        <a class="dropdown-item" href="{{ url('tienda?categoria=' . urlencode($categoria->nombre)) }}">
                            {{ $categoria->nombre }}
                        </a>
                    @endforeach
                </div>
            </div>
</div>


        <form action="{{ route('buscar') }}" method="GET" class="navbar-search">
            <input type="text" name="query" placeholder="Buscar producto" required />
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>

        <div class="cart-icon">
            <a href="{{ route('cart.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                    <path d="M7 4h14a1 1 0 011 1v2a1 1 0 01-1 1h-1.34l-1.6 6.01a3 3 0 01-2.92 2.26H9.46a3 3 0 01-2.92-2.26L4.94 8H3a1 1 0 01-1-1V5a1 1 0 011-1zm1 2l1.34 5.01a1 1 0 00.98.79h10.48a1 1 0 00.97-.79L19 6H8zm1 11a2 2 0 110 4 2 2 0 010-4zm10 0a2 2 0 110 4 2 2 0 010-4z"/>
                </svg>
                <span id="cart-count" class="cart-count">0</span> <!-- Contador dinámico -->
            </a>
        </div>
        
        
        
        <div class="navbar-menu">
            @if(Auth::check()) <!-- Verifica si hay un usuario autenticado -->
                <span class="navbar-welcome">Hola, {{ Auth::user()->nombre }}!</span> <!-- Muestra el nombre del usuario -->
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf <!-- Incluye el token CSRF para la seguridad -->
                    <button type="submit" class="logout-btn">Cerrar sesión</button> <!-- Botón para cerrar sesión -->
                </form>
            @else
                <a href="{{ route('login') }}"><button class="login-btn">Iniciar Sesión</button></a>
                <a href="{{ route('register') }}"><button class="register-btn">Registrarse</button></a>
            @endif
        </div>
        


        

    </header>
<div></div>

    <div class="page-content mt-5">
        @yield('content')
    </div>
</div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 La Familia. Todos los derechos reservados.</p>

    </footer>



    <script>
        $(document).ready(function () {
            // Al hacer clic en el botón de menú, alterna el menú
            $('.hamburger').on('click', function () {
                $('.navbar-menu').toggleClass('active');
            });
    
            // Ocultar el menú al hacer clic en cualquier enlace del menú
            $('.navbar-menu a').on('click', function () {
                $('.navbar-menu').removeClass('active');
            });
        });
    </script>
    

    <script>
        $(document).ready(function() {
            $('#resultadosModal').modal('show'); // Mostrar el modal al cargar la página
        });
    </script>

<script>$(document).ready(function () {
    $(document).click(function (event) {
        var clickover = $(event.target);
        var isOpen = $("#categoriasMenu").hasClass("show");
        if (isOpen && !clickover.closest('#dropdownTienda').length) {
            $("#categoriasMenu").collapse('hide');
        }
    });
});</script>


</body>
</html>
