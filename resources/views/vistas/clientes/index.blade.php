@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="my-4">Lista de Clientes</h1>

    <!-- Botón para abrir el modal de crear nuevo cliente -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearClienteModal">
        Crear Nuevo Cliente
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
                <th scope="col">DNI</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Dirección</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr>
                <th scope="row">{{ $cliente->id_cliente }}</th>
                <td>{{ $cliente->dni }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->apellido }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td>{{ $cliente->correo }}</td>
                <td>
                    <!-- Botón para ver detalles del cliente en un modal -->
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#verClienteModal{{ $cliente->id_cliente }}">Ver</button>

                    <!-- Botón para editar cliente en un modal -->
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarClienteModal{{ $cliente->id_cliente }}">Editar</button>

                    <!-- Botón para eliminar cliente en un modal de confirmación -->
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminarClienteModal{{ $cliente->id_cliente }}">Eliminar</button>
                </td>
            </tr>

            <!-- Modal Ver Cliente -->
            <div class="modal fade" id="verClienteModal{{ $cliente->id_cliente }}" tabindex="-1" aria-labelledby="verClienteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verClienteModalLabel">Detalles del Cliente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>DNI:</strong> {{ $cliente->dni }}</p>
                            <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
                            <p><strong>Apellido:</strong> {{ $cliente->apellido }}</p>
                            <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                            <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
                            <p><strong>Correo:</strong> {{ $cliente->correo }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Editar Cliente -->
            <div class="modal fade" id="editarClienteModal{{ $cliente->id_cliente }}" tabindex="-1" aria-labelledby="editarClienteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarClienteModalLabel">Editar Cliente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('clientes.update', $cliente->id_cliente) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="dni" class="form-label">DNI</label>
                                    <input type="text" class="form-control" name="dni" value="{{ $cliente->dni }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="{{ $cliente->nombre }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="apellido" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" name="apellido" value="{{ $cliente->apellido }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" name="telefono" value="{{ $cliente->telefono }}">
                                </div>
                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" name="direccion" value="{{ $cliente->direccion }}">
                                </div>
                                <div class="mb-3">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" name="correo" value="{{ $cliente->correo }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Eliminar Cliente -->
            <div class="modal fade" id="eliminarClienteModal{{ $cliente->id_cliente }}" tabindex="-1" aria-labelledby="eliminarClienteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eliminarClienteModalLabel">Eliminar Cliente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas eliminar a {{ $cliente->nombre }} {{ $cliente->apellido }}?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>

    @if ($clientes->isEmpty())
        <p class="text-center">No hay clientes registrados.</p>
    @endif
</div>

<!-- Modal para crear un nuevo cliente -->
<div class="modal fade" id="crearClienteModal" tabindex="-1" aria-labelledby="crearClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearClienteModalLabel">Crear Nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para crear un nuevo cliente -->
                <form action="{{ route('clientes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" class="form-control" name="dni" value="{{ old('dni') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" required>
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
                        <input type="email" class="form-control" name="correo" value="{{ old('correo') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

