<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\User;

class ProductosTiendaController extends Controller
{
    
    // Listar todos los productos con su categoría
    public function index()
    {
        //$productos = Producto::with('categoria')->get(); // Carga productos con su categoría
        //$categorias = Categoria::all(); // Cargar todas las categorías para el select
        //return view('vistas.productos.index', compact('productos','categorias' ));
        $productos = Producto::all();
        return view('vistas.tienda', ['productos' => $productos]);
    }

   // Agregar un producto al carrito
   public function addToCart($id_producto, Request $request)
{
    $producto = Producto::find($id_producto);
    $cantidad = $request->input('cantidad', 1); // Obtener cantidad o usar 1 por defecto

    // Obtener el carrito actual de la sesión
    $cart = session()->get('cart', []);

    // Agregar producto con la cantidad seleccionada
    if (isset($cart[$id_producto])) {
        $cart[$id_producto]['cantidad'] += $cantidad; // Incrementar si ya existe
    } else {
        $cart[$id_producto] = [
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'cantidad' => $cantidad, // Asignar cantidad seleccionada
        ];
    }

    // Guardar carrito en la sesión
    session()->put('cart', $cart);

    // Retornar respuesta con el nuevo conteo del carrito
    return response()->json(['cartCount' => count($cart)]);
}

   
   // Mostrar el conten_productoo del carrito
   public function cart()
   {
       $cart = session()->get('cart', []); // Obtener el carrito desde la sesión
       return view('vistas.cart', compact('cart'));
   }

   // Eliminar un producto del carrito
   public function removeFromCart($id_producto)
   {
       $cart = session()->get('cart', []);

       if (isset($cart[$id_producto])) {
           unset($cart[$id_producto]); // Eliminar el producto del carrito
           session()->put('cart', $cart); // Actualizar la sesión
       }

       return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
   }

   // Vaciar el carrito
   public function clearCart()
   {
       session()->forget('cart'); // Eliminar el carrito de la sesión
       return redirect()->route('cart.index')->with('success', 'Carrito vaciado.');
   }
}