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
    $request->validate([
        'id_cliente' => 'nullable|exists:cliente,id_cliente',
        'productos' => 'required|array',
        'productos.*.id_producto' => 'exists:producto,id_producto',
        'productos.*.cantidad' => 'required|integer|min:1',
        'fecha' => 'required|date',
        'total' => 'required|numeric',
        'descuento' => 'nullable|numeric',
        'pagoTotal' => 'required|numeric',
    ]);

    // Crear la venta
    $venta = Venta::create([
        'id_cliente' => $request->id_cliente,
        'fecha' => $request->fecha,
        'total' => $request->total,
        'descuento' => $request->descuento ?? 0,
        'pagoTotal' => $request->pagoTotal,
    ]);

    // Guardar los productos asociados a la venta
    foreach ($request->productos as $productoData) {
        VentaProducto::create([
            'id_venta' => $venta->id_venta,
            'id_producto' => $productoData['id_producto'],
            'cantidad' => $productoData['cantidad'],
            'precio' => Producto::find($productoData['id_producto'])->precio,
        ]);
    }

    return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');


}

public function update(Request $request, $id_venta)

{
    // Validar los datos del formulario
    $request->validate([
        'id_cliente' => 'nullable|exists:cliente,id_cliente',
        'productos' => 'required|array',
        'productos.*' => 'exists:producto,id_producto',
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

    // Eliminar productos existentes y agregar los nuevos
    $venta->ventaProductos()->delete();
    foreach ($request->productos as $id_producto) {
        $producto = Producto::findOrFail($id_producto);
        VentaProducto::create([
            'id_venta' => $venta->id_venta,
            'id_producto' => $producto->id_producto,
            'cantidad' => 1,  // Puedes cambiar esto para permitir la selección de la cantidad
            'precio' => $producto->precio,
        ]);
    }

    return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
}

public function edit($id_venta)
{
    // Encontrar la venta por su id
    $venta = Venta::findOrFail($id_venta);
    $clientes = Cliente::all();
    $productos = Producto::all();
    
    // Pasar la venta, los clientes y los productos a la vista de edición
    return view('vistas.ventas.edit', compact('venta', 'clientes', 'productos'));
}



    // Mostrar detalles de una venta específica
    public function show($id_venta)
    {
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

