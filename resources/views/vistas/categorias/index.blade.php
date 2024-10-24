@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="my-4">Lista de Categorías</h1>

    <!-- Botón para abrir el modal de crear nueva categoría -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearCategoriaModal">
        Crear Nueva Categoría
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
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th> <!-- Nueva columna de Descripción -->
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
            <tr>
                <th scope="row">{{ $categoria->id_categoria }}</th>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->descripcion }}</td> <!-- Mostrar la descripción -->
                <td>
                    <!-- Botón para ver detalles de la categoría en un modal -->
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#verCategoriaModal{{ $categoria->id_categoria }}">Ver</button>
    
                    <!-- Botón para editar categoría en un modal -->
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarCategoriaModal{{ $categoria->id_categoria }}">Editar</button>
    
                    <!-- Botón para eliminar categoría en un modal de confirmación -->
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminarCategoriaModal{{ $categoria->id_categoria }}">Eliminar</button>
                </td>
            </tr>
    

            <!-- Modal Ver Categoría -->
            <div class="modal fade" id="verCategoriaModal{{ $categoria->id_categoria }}" tabindex="-1" aria-labelledby="verCategoriaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verCategoriaModalLabel">Detalles de la Categoría</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Nombre:</strong> {{ $categoria->nombre }}</p>
                        </div>
                        <div class="modal-body">
                            <p><strong>descripcion:</strong> {{ $categoria->descripcion }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

           <!-- Modal Editar Categoría -->
<div class="modal fade" id="editarCategoriaModal{{ $categoria->id_categoria }}" tabindex="-1" aria-labelledby="editarCategoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarCategoriaModalLabel">Editar Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categorias.update', $categoria->id_categoria) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{ $categoria->nombre }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <!-- Aquí debes poner el valor entre las etiquetas de apertura y cierre de textarea -->
                        <textarea class="form-control" name="descripcion" required>{{ $categoria->descripcion }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

            <!-- Modal Eliminar Categoría -->
            <div class="modal fade" id="eliminarCategoriaModal{{ $categoria->id_categoria }}" tabindex="-1" aria-labelledby="eliminarCategoriaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eliminarCategoriaModalLabel">Eliminar Categoría</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas eliminar la categoría {{ $categoria->nombre }}?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('categorias.destroy', $categoria->id_categoria) }}" method="POST">
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

    @if ($categorias->isEmpty())
        <p class="text-center">No hay categorías registradas.</p>
    @endif
</div>

<!-- Modal para crear una nueva categoría -->
<div class="modal fade" id="crearCategoriaModal" tabindex="-1" aria-labelledby="crearCategoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearCategoriaModalLabel">Crear Nueva Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para crear una nueva categoría -->
                <form action="{{ route('categorias.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion">{{ old('descripcion') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Categoría</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection
