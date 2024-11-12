@extends('layouts.navbar')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-8 col-lg-6">
        <h3 class="text-center mb-4">Registrar Cliente</h3>
        <form action="{{ route('register.cliente') }}" method="POST" class="p-4 border rounded bg-white shadow-sm">
            @csrf
            <!-- Campo oculto para indicar que es un cliente -->
    <input type="hidden" name="is_client" value="true">



            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <div class="input-group">
                    <input type="text" id="dni" class="form-control" name="dni" required>
                    <div id="spinner" class="spinner-border text-primary" role="status" style="display: none;">
                        <span class="sr-only">Cargando...</span>
                    </div>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary" id="btnBuscarDNI">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" class="form-control" name="nombre" required disabled>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" id="apellido" class="form-control" name="apellido" required disabled>
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" id="usuario" class="form-control" name="usuario" required disabled>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" id="password" class="form-control" name="password" required disabled>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>
            

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" id="telefono" class="form-control" name="telefono" disabled>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" id="correo" class="form-control" name="correo" disabled>
            </div>

            

            <div class="mb-3">
                <label for="tipo_usuario" class="form-label">Tipo de Usuario</label>
                <select id="tipo_usuario" name="tipo_usuario" class="form-control" required disabled>
                   
                    <option value="2">Cliente</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100" disabled id="submitButton">Registrar Cliente</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-2">Cancelar</a>
        </form>
    </div>
</div>

<div style="margin-bottom: 100px;"></div> <!-- Espacio adicional -->


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<script>
    document.getElementById('btnBuscarDNI').addEventListener('click', function() {
        const dni = document.getElementById('dni').value;
        if (dni) {
            // Simular la búsqueda del DNI (puedes hacer una llamada AJAX aquí para buscar el DNI en tu base de datos)
            // Suponiendo que la búsqueda fue exitosa, habilitamos los campos restantes
            document.querySelectorAll('#nombre, #apellido, #usuario, #password, #telefono, #correo, #estado, #tipo_usuario, #submitButton').forEach(field => {
                field.disabled = false;
            });
        } else {
            alert('Por favor, ingresa un DNI válido.');
        }
    });
</script>
@endsection



<script>
    document.addEventListener("DOMContentLoaded", function () {
    let boton = document.getElementById("btnBuscarDNI");
    let spinner = document.getElementById("spinner");

    if (boton) {
        boton.addEventListener("click", traerDatos);
    }

    function traerDatos() {
        let dni = document.getElementById("dni").value;

        if (dni.length !== 8) {
            alert("El DNI debe tener 8 dígitos");
            return;
        }

        spinner.style.display = "inline-block"; // Mostrar el spinner

        fetch(`https://apiperu.dev/api/dni/${dni}?api_token=02f4012d0ba37472a24b19be382db6bff0697ef0ff262870bd0767f8f730e5db`)
            .then(response => {
                if (!response.ok) {
                    if (response.status === 401) {
                        throw new Error("Token de API inválido o caducado.");
                    } else if (response.status === 404) {
                        throw new Error("DNI no encontrado.");
                    } else {
                        throw new Error("Error en la solicitud a la API.");
                    }
                }
                return response.json();
            })
            .then(datos => {
                if (datos.success) {
                    console.log(datos.data);
                    document.getElementById("nombre").value = datos.data.nombres;
                    document.getElementById("apellido").value =
                        `${datos.data.apellido_paterno} ${datos.data.apellido_materno}`;
                } else {
                    alert("DNI no encontrado");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert(`Error: ${error.message}`);
            })
            .finally(() => {
                spinner.style.display = "none"; // Ocultar el spinner
            });
    }
});

</script>
