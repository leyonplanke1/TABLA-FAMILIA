@extends('layouts.navbar')

@section('content')

<!-- Botón para abrir el modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#resultadosModal">
    Ver resultados
</button>

<!-- Modal -->
<div class="modal fade" id="resultadosModal" tabindex="-1" aria-labelledby="resultadosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultadosModalLabel">Resultados de Búsqueda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($productos->isEmpty())
                    <p>No se encontraron productos.</p>
                @else
                    <div class="product-grid">
                        @foreach ($productos as $producto)
                            <div class="product-card">
                                <h2>{{ $producto->nombre }}</h2>
                                <p>S/. {{ number_format($producto->precio, 2) }}</p>
                                <button class="btn btn-success add-to-cart" data-id="{{ $producto->id_producto }}">
                                    Agregar al Carrito
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const botonesAgregar = document.querySelectorAll('.add-to-cart');

    botonesAgregar.forEach(boton => {
        boton.addEventListener('click', function () {
            const idProducto = this.getAttribute('data-id');

            // Enviar la solicitud AJAX al controlador
            fetch(`{{ url('/cart/add') }}/${idProducto}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ cantidad: 1 })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                alert('Producto agregado al carrito.');
                document.getElementById('cart-count').textContent = data.cartCount; // Actualizar el contador del carrito
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

</script>

