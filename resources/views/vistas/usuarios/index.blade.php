@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="my-4">Lista de Usuarios</h1>

    <!-- Botón para abrir el modal de crear nuevo usuario -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearUsuarioModal">
        Crear Nuevo Usuario
    </button>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Usuario</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Correo</th>
               
                <th scope="col">Estado</th>
                <th scope="col">Tipo Usuario</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <th scope="row">{{ $usuario->id_usuario }}</th>
                <td>{{ $usuario->usuario }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->apellido }}</td>
                <td>{{ $usuario->telefono }}</td>
                <td>{{ $usuario->correo }}</td>
                
                <td>{{ $usuario->estado ? 'Activo' : 'Inactivo' }}</td>
                <td>{{ $usuario->tipo_usuario }}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#verUsuarioModal{{ $usuario->id_usuario }}">Ver</button>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarUsuarioModal{{ $usuario->id_usuario }}">Editar</button>
                    <!-- Botón Eliminar con Confirmación -->
                    <form action="{{ route('usuarios.destroy', $usuario->id_usuario) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de querer eliminar este usuario?');">Eliminar</button>
                    </form>

                </td>
            </tr>

            <!-- Modal Ver Usuario -->
            <div class="modal fade" id="verUsuarioModal{{ $usuario->id_usuario }}" tabindex="-1" aria-labelledby="verUsuarioModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verUsuarioModalLabel">Detalles del Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Usuario:</strong> {{ $usuario->usuario }}</p>
                            <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
                            <p><strong>Apellido:</strong> {{ $usuario->apellido }}</p>
                            <p><strong>Teléfono:</strong> {{ $usuario->telefono }}</p>
                            <p><strong>Correo:</strong> {{ $usuario->correo }}</p>
                            
                            <p><strong>Estado:</strong> {{ $usuario->estado ? 'Activo' : 'Inactivo' }}</p>
                            <p><strong>Tipo Usuario:</strong> {{ $usuario->tipo_usuario }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Editar Usuario -->
            <div class="modal fade" id="editarUsuarioModal{{ $usuario->id_usuario }}" tabindex="-1" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarUsuarioModalLabel">Editar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="usuario" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" name="usuario" value="{{ $usuario->usuario }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="{{ $usuario->nombre }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="apellido" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" name="apellido" value="{{ $usuario->apellido }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" name="telefono" value="{{ $usuario->telefono }}">
                                </div>
                                <div class="mb-3">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" name="correo" value="{{ $usuario->correo }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select class="form-control" name="estado" required>
                                        <option value="1" {{ $usuario->estado ? 'selected' : '' }}>Activo</option>
                                        <option value="0" {{ !$usuario->estado ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo_usuario" class="form-label">Tipo Usuario</label>
                                    <input type="number" class="form-control" name="tipo_usuario" value="{{ $usuario->tipo_usuario }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>

    @if ($usuarios->isEmpty())
        <p class="text-center">No hay usuarios registrados.</p>
    @endif
</div>

<!-- Modal para crear un nuevo usuario -->
<div class="modal fade" id="crearUsuarioModal" tabindex="-1" aria-labelledby="crearUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearUsuarioModalLabel">Crear Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('usuarios.store') }}" method="POST">
                    @csrf

                 

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" required>
                    </div>


                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}">
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}">
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo" value="{{ old('correo') }}">
                    </div>

                    
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-control select2" name="estado" required>
                            <option value="1" selected>Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tipo_usuario" class="form-label">Tipo de Usuario</label>
                        <select name="tipo_usuario" class="form-control select2" required>
                            <option value="1" {{ old('tipo_usuario') == 1 ? 'selected' : '' }}>Administrador</option>
                            <option value="2" {{ old('tipo_usuario') == 2 ? 'selected' : '' }}>Cliente</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif






@endsection
