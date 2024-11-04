<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\VentaProducto;
use App\Models\Usuario;
use App\Models\Producto;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    // Mostrar listado de todas las ventas
    public function index()
    {
        $ventas = Venta::with('usuario', 'ventaProductos.producto')->get();
       
        return view('vistas.ventas.index', compact('ventas'));
    }

    // Mostrar formulario para crear una venta
    public function create()
    {
        $usuarios = Usuario::all();
        $productos = Producto::all();
        return view('vistas.ventas.create', compact('usuarios', 'productos'));
    }

    // Guardar nueva venta
    public function store(Request $request)
    {
        // Validación del formulario
        

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
            'id_usuario' => $request->id_usuario,
            'fecha' => $request->fecha,
            'total' => $total,
            
            'pagoTotal' => $pagoTotal,
            
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
            'id_usuario' => 'required|exists:usuario,id_usuario',
            'productos' => 'required|json', // Validar que productos esté presente y sea JSON válido
            'total' => 'required|numeric',
            'pagoTotal' => 'required|numeric'
        ]);
    
        // Decodificar productos en un array
        $productos = json_decode($request->productos, true);
    
        // Verificar que productos sea un array después de decodificar
        if (!is_array($productos)) {
            return redirect()->back()->withErrors(['productos' => 'Productos debe ser un array.']);
        }
    
        // Encontrar la venta existente
        $venta = Venta::findOrFail($id_venta);
    
        // Actualizar los datos de la venta
        $venta->update([
            'id_usuario' => $request->id_usuario,
            'total' => $request->total,
            'descuento' => $request->descuento ?? 0,
            'pagoTotal' => $request->pagoTotal,
        ]);
    
        // Eliminar los productos actuales y agregar los nuevos
        $venta->ventaProductos()->delete();
        foreach ($productos as $producto) {
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
        $usuarios = Usuario::all();
        $productos = Producto::all();

        return view('vistas.ventas.edit', compact('venta', 'usuarios', 'productos'));
    }

    public function show($id_venta)
    {
        // Encontrar la venta por ID con el usuario y los productos relacionados
        $venta = Venta::with('usuario', 'ventaProductos.producto')->findOrFail($id_venta);

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
