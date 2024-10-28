<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\VentaProducto;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    // Mostrar listado de todas las ventas
    public function index()
    {
        $ventas = Venta::with('cliente', 'ventaProductos.producto')->get();
        return view('vistas.ventas.index', compact('ventas'));
    }

    // Mostrar formulario para crear una venta
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('vistas.ventas.create', compact('clientes', 'productos'));
    }

    // Guardar nueva venta
    public function store(Request $request)
{
    // Validación del formulario
    $request->validate([
       
    ]);

    // Capturar los productos y calcular el total
    $total = 0;
    foreach (json_decode($request->productos, true) as $producto) {
        $productoModelo = Producto::find($producto['id_producto']);
        $subtotal = $productoModelo->precio * $producto['cantidad'];
        $total += $subtotal;
    }

    // Capturar el descuento y calcular el total a pagar
    $descuento = $request->input('descuento', 0);
    $pagoTotal = $total - $descuento;

    // Crear la venta
    $venta = Venta::create([
        'id_cliente' => $request->id_cliente,
        'fecha' => $request->fecha,
        'total' => $total,
        'descuento' => $descuento,
        'pagoTotal' => $pagoTotal,
        'comprobante' => $request->comprobante,
        'impuesto' => $request->impuesto,
    ]);

    // Guardar los productos relacionados
    foreach (json_decode($request->productos, true) as $producto) {
        VentaProducto::create([
            'id_venta' => $venta->id_venta,
            'id_producto' => $producto['id_producto'],
            'cantidad' => $producto['cantidad'],
            'precio' => Producto::find($producto['id_producto'])->precio,
        ]);
    }

    return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
}

    
    

    // Actualizar una venta existente
    public function update(Request $request, $id_venta)
    {
        // Validar los datos del formulario
        $request->validate([
    'id_cliente' => 'required|exists:cliente,id_cliente',
    'productos' => 'required|array|min:1',
    'productos.*.id_producto' => 'required|exists:producto,id_producto',
    'productos.*.cantidad' => 'required|integer|min:1',
    'fecha' => 'required|date',
    'total' => 'required|numeric',
    'descuento' => 'nullable|numeric',
    'pagoTotal' => 'required|numeric',
]);

        // Encontrar la venta existente
        $venta = Venta::findOrFail($id_venta);

        // Actualizar los datos de la venta
        $venta->update([
            'id_cliente' => $request->id_cliente,
            'total' => $request->total,
            'descuento' => $request->descuento ?? 0,
            'pagoTotal' => $request->pagoTotal,
        ]);

        // Eliminar los productos actuales y agregar los nuevos
        $venta->ventaProductos()->delete();
        foreach ($request->productos as $producto) {
            $productoModelo = Producto::find($producto['id_producto']);
            if ($productoModelo) {
                VentaProducto::create([
                    'id_venta' => $venta->id_venta,
                    'id_producto' => $productoModelo->id_producto,
                    'cantidad' => $producto['cantidad'],
                    'precio' => $productoModelo->precio,
                ]);
            }
        }

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }

    // Mostrar formulario de edición de una venta
    public function edit($id_venta)
{
    // Encontrar la venta por ID con los productos relacionados
    $venta = Venta::with('ventaProductos.producto')->findOrFail($id_venta);
    $clientes = Cliente::all();
    $productos = Producto::all();

    return view('vistas.ventas.edit', compact('venta', 'clientes', 'productos'));
}

public function show($id_venta)
{
    // Encontrar la venta por ID con el cliente y los productos relacionados
    $venta = Venta::with('cliente', 'ventaProductos.producto')->findOrFail($id_venta);

    return view('vistas.ventas.show', compact('venta'));
}


    // Eliminar una venta
    public function destroy($id_venta)
    {
        $venta = Venta::findOrFail($id_venta);
        $venta->ventaProductos()->delete(); // Eliminar productos relacionados
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
}
