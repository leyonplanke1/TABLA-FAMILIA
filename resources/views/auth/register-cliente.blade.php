@extends('layouts.navbar')

@section('content')

<style>
/* Estilos personalizados */
.container {
    min-height: 120vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #e9ecef;
    padding: 20px;
    box-sizing: border-box;
}

.card {
    border-radius: 20px;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    max-width: 600px;
    width: 100%;
}

.card-header {
    background: linear-gradient(135deg, #FF8C00, #D2691E);
    color: white;
    text-align: center;
    font-weight: bold;
    font-size: 1.5rem;
    padding: 1.5rem 0;
    border-bottom: none;
}

.card-body {
    padding: 30px;
}

.form-control {
    border-radius: 30px;
    padding: 12px 20px;
    border: 1px solid #ced4da;
    transition: all 0.3s ease-in-out;
}

.form-control:focus {
    border-color: #5b86e5;
    box-shadow: 0 0 10px rgba(91, 134, 229, 0.5);
}

.btn-gradient {
    background: linear-gradient(135deg, #D2691E, #FF8C00);
    border: none;
    color: white;
    padding: 12px 30px;
    border-radius: 50px;
    transition: all 0.3s ease-in-out;
    font-weight: bold;
    width: 100%;
}

.btn-gradient:hover {
    background: linear-gradient(135deg, #5b86e5, #36d1dc);
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    transform: scale(1.05);
}

.card-footer {
    text-align: center;
    background-color: #f8f9fa;
    padding: 15px;
}

.card-footer a {
    text-decoration: none;
    color: #5b86e5;
    font-weight: bold;
}
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            Registro de Cliente
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register.cliente') }}">
                @csrf

                <div class="mb-4">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input id="nombre" type="text" name="nombre" class="form-control" placeholder="Ingresa tu nombre" required>
                </div>

                <div class="mb-4">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input id="apellido" type="text" name="apellido" class="form-control" placeholder="Ingresa tu apellido" required>
                </div>

                
                <div class="mb-4">
                    <label for="dni" class="form-label">DNI</label>
                    <input id="dni" type="text" name="dni" class="form-control" placeholder="Ingresa tu DNI" required>
                </div>

                <div class="mb-4">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input id="correo" type="email" name="correo" class="form-control" placeholder="Ingresa tu correo electrónico" required>
                </div>


                <div class="mb-4">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input id="usuario" type="text" name="usuario" class="form-control" placeholder="Elige un nombre de usuario" required>
                </div>


                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" type="password" name="password" class="form-control" placeholder="Crea una contraseña" required>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirma tu contraseña" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-gradient">Registrar Cliente</button>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <small>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a></small>
        </div>
    </div>
</div>

@endsection
