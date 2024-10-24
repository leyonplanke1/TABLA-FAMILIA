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


    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">




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
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            z-index: 100;
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
                display: none;
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
        background-color: #18bc9c; /* Color de fondo */
        color: white; /* Color del texto */
        border: none; /* Sin borde */
        padding: 10px 15px; /* Espaciado interno */
        border-radius: 5px; /* Bordes redondeados */
        cursor: pointer; /* Cambia el cursor a puntero */
        transition: background-color 0.3s; /* Transición para el efecto hover */
        margin-left: 10px; /* Espacio entre botones */
    }

    .login-btn:hover, .register-btn:hover, .logout-btn:hover {
        background-color: #16a085; /* Cambia el color al pasar el ratón */
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

        <div class="navbar-menu">
            <a href="http://localhost/sistema-lafamilia/sis-familia/public/welcome">Inicio</a>
            <a href="http://localhost/sistema-lafamilia/sis-familia/public/nosotros">Nosotros</a>
            <a href="http://localhost/sistema-lafamilia/sis-familia/public/contacto">Contáctanos</a>
            <a href="http://localhost/sistema-lafamilia/sis-familia/public/tienda">Tienda Virtual</a>
        </div>

        <div class="navbar-search">
            <input type="text" placeholder="Buscar producto">
            <button><i class="fa fa-search"></i></button>
        </div>

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
                <form action="{{ route('login') }}" method="POST" style="display: inline;">
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
        <p>&copy; 2024 Mi Web Moderna. Todos los derechos reservados.</p>
    </footer>

    
</body>
</html>
