<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\VentaProducto;
use App\Models\Usuario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
    

    public function reporte(Request $request)
{
    $filter = $request->input('filter', 'all');

    if ($filter == 'today') {
        // Filtrar ventas de hoy
        $ventas = Venta::with('usuario')->whereDate('fecha', now()->toDateString())->get();
    } else {
        // Obtener todas las ventas
        $ventas = Venta::with('usuario')->get();
    }

    return view('vistas.ventas.reporte', compact('ventas'));
}



public function generarPdf(Request $request)
{
    // Obtiene el valor del filtro de la solicitud (por defecto 'all' si no se proporciona)
    $filter = $request->get('filter', 'all');

    // Filtra las ventas según el valor del filtro seleccionado
    if ($filter === 'today') {
        // Si el filtro es 'today', obtiene solo las ventas del día actual
        $ventas = Venta::whereDate('fecha', now()->toDateString())->with('usuario')->get();
        
        // Define el nombre del archivo PDF para ventas del día
        $nombreArchivo = 'Ventas_del_Dia.pdf';
    } else {
        // Si el filtro es 'all', obtiene todas las ventas
        $ventas = Venta::with('usuario')->get();
        
        // Define el nombre del archivo PDF para ventas totales
        $nombreArchivo = 'Ventas_Totales.pdf';
    }

    // Genera el PDF con la vista 'reporte_pdf', pasando las ventas como datos
    $pdf = PDF::loadView('vistas.ventas.reporte_pdf', compact('ventas'));

    // Descarga el archivo PDF con el nombre asignado según el filtro
    return $pdf->download($nombreArchivo);
}





    public function cambiarEstado(Request $request, $id)
{
    $venta = Venta::findOrFail($id); // Encuentra la venta por su ID
    $venta->estado_envio = $request->input('estado_envio'); // Actualiza el estado
    $venta->save(); // Guarda los cambios en la base de datos

    return redirect()->route('ventas.index')->with('success', 'Estado de envío actualizado correctamente.');
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
