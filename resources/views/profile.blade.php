@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header text-center bg-primary text-white">
                <h3>Perfil de Usuario</h3>
            </div>
            <div class="card-body">
                <!-- Usuario -->
                <div class="mb-3">
                    <h5>Usuario</h5>
                    <p>{{ auth()->user()->usuario }}</p>
                </div>

                <!-- Nombre Completo -->
                <div class="mb-3">
                    <h5>Nombre Completo</h5>
                    <p>{{ auth()->user()->nombre }} {{ auth()->user()->apellido }}</p>
                </div>

                <!-- DNI -->
                <div class="mb-3">
                    <h5>DNI</h5>
                    <p>{{ auth()->user()->dni }}</p>
                </div>

                <!-- Correo Electrónico -->
                <div class="mb-3">
                    <h5>Correo Electrónico</h5>
                    <p>{{ auth()->user()->correo }}</p>
                </div>

                <!-- Teléfono -->
                <div class="mb-3">
                    <h5>Teléfono</h5>
                    <p>{{ auth()->user()->telefono }}</p>
                </div>

                <!-- Estado -->
                <div class="mb-3">
                    <h5>Estado</h5>
                    <p>{{ auth()->user()->estado }}</p>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('password.request') }}" class="btn btn-warning w-48">Cambiar Contraseña</a>
                    <a href="{{ route('home') }}" class="btn btn-secondary w-48">Volver al Inicio</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
