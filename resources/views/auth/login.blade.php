<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <title>Inicio de Sesión</title>

    <style>
        body {
            background: linear-gradient(135deg, #FFF8DC 20%, #FAF0E6 80%);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 15px;
        }

        .login-card {
            background-color: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s ease-in-out;
        }

        .login-card:hover {
            transform: scale(1.03);
        }

        .login-img img {
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;
            animation: fadeIn 1s ease-in-out;
        }

        h2.title {
            font-weight: 600;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-floating {
            position: relative;
            margin-bottom: 20px;
        }

        .form-floating input {
            border-radius: 30px;
            padding: 15px 20px;
            border: 2px solid #D2691E;
            background-color: #F9F9F9;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-floating input:focus {
            border-color: #A0522D;
            background-color: #FFF;
        }

        .form-floating label {
            color: #D2691E;
            transition: all 0.3s ease;
        }

        .form-floating input:focus + label,
        .form-floating input:not(:placeholder-shown) + label {
            font-size: 12px;
            top: 5px;
            color: #A0522D;
        }

        .btn-login {
            background-color: #D2691E;
            border: none;
            padding: 15px;
            border-radius: 30px;
            width: 100%;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #A0522D;
        }

        .view .fa-eye {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #D2691E;
        }

        .text-center a {
            color: #A0522D;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .text-center a:hover {
            color: #D2691E;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 d-none d-lg-block login-img">
                <img src="{{ asset('inicio/img/familia4.png') }}" alt="Logo">
            </div>

            <div class="col-lg-6">
                <div class="login-card">
                    <h2 class="title" style="color: #D2691E; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);">
                        BIENVENIDO
                    </h2>

                    @if (session('mensaje'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <small>{{ session('mensaje') }}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-floating">
                            <input type="text" class="form-control @error('usuario') is-invalid @enderror" 
                                   id="usuario" name="usuario" placeholder="Usuario"
                                   value="{{ old('usuario') }}" required>
                            <label for="usuario">
                                <i class="fas fa-user me-2"></i> Usuario
                            </label>
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" placeholder="Contraseña" required>
                            <label for="password">
                                <i class="fas fa-lock me-2"></i> Contraseña
                            </label>
                        </div>

                        <div class="text-center mb-3">
                            <a href="#" class="font-italic">Olvidé mi contraseña</a>
                        </div>

                        <button type="submit" class="btn-login">INICIAR SESIÓN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
