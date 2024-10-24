@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de Administrador') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.admin') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">{{ __('Nombre') }}</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="apellido">{{ __('Apellido') }}</label>
                            <input id="apellido" type="text" class="form-control" name="apellido" required>
                        </div>

                        <div class="form-group">
                            <label for="correo">{{ __('Correo Electrónico') }}</label>
                            <input id="correo" type="email" class="form-control" name="correo" required>
                        </div>

                        <div class="form-group">
                            <label for="usuario">{{ __('Nombre de Usuario') }}</label>
                            <input id="usuario" type="text" class="form-control" name="usuario" required>
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Registrar Administrador') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
