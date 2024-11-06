<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Barryvdh\DomPDF\Facade\Pdf; // Importar Dompdf
use Illuminate\Support\Facades\Auth;
use App\Models\Venta;
use App\Models\VentaProducto;

class ProductosTiendaController extends Controller
{
    

    
    // Listar todos los productos con su categoría
    public function index(Request $request)
    {
        $categoriaSeleccionada = $request->get('categoria'); // Captura la categoría seleccionada

        if ($categoriaSeleccionada) {
            $productos = Producto::whereHas('categoria', function ($query) use ($categoriaSeleccionada) {
                $query->where('nombre', $categoriaSeleccionada);
            })->get();
        } else {
            $productos = Producto::all(); // Si no hay categoría seleccionada, muestra todos
        }

        $categorias = Categoria::all(); // Cargar todas las categorías para la vista
        return view('vistas.tienda', compact('productos', 'categorias'));
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
       // Obtener el carrito desde la sesión
       $cart = session()->get('cart', []);
       $total = 0;
   
       foreach ($cart as $item) {
           $total += $item['precio'] * $item['cantidad'];
       }
   
       return view('vistas.cart', compact('cart', 'total'));
   }

   // Método de checkout para procesar el pago y generar el PDF
   public function checkout(Request $request)
{


    session()->get('cart');

    $cart = session()->get('cart', []);
    $subtotal = 0;

    // Calcular el subtotal y el precio con IGV para cada producto
    foreach ($cart as &$item) {
        $item['precio_con_igv'] = $item['precio'] ; // Aplica IGV al precio unitario
        $subtotal += $item['precio_con_igv'] * $item['cantidad'];
    }

    // Asigna el carrito actualizado con precios de IGV a la sesión
    session()->put('cart', $cart);

   

    // Datos del usuario y otros detalles
    $usuario = Auth::user();
    $direccion = $request->input('direccion');
    $metodoEnvio = $request->input('metodo_envio');
    $metodoPago = $request->input('metodo_pago');
    $costoEnvio = $metodoEnvio === 'express' ? 10.00 : 5.00;
    $costoEnvioConIgv = $costoEnvio ;
    $totalFinal = $subtotal + $costoEnvioConIgv;

    // Ajuste del costo de envío según el método seleccionado
    $costoEnvio = $metodoEnvio === 'express' ? 10.00 : 5.00;
    $costoEnvioConIgv = $costoEnvio ; // Aplica IGV al costo de envío
    $totalFinal = $subtotal + $costoEnvioConIgv;


    // Crear registro de la venta
    $venta = new Venta();
    $venta->id_usuario = $usuario->id_usuario; // Guardar el ID del usuario autenticado
    
    
    $venta->total = $totalFinal; // Guarda el total
    $venta->pagoTotal = $totalFinal;  // Guarda el total
    $venta->fecha = now(); // Guarda la fecha actual
    $venta->save(); // Guarda la venta en la base de datos

        // Guardar detalles de la venta en venta_detalle
        
        // Guardar detalles de la venta en venta_detalle
   /*foreach ($cart as $id_producto => $item) {
    $detalle = new VentaProducto(); // Instancia del modelo correcto
    $detalle->id_venta = $venta->id_venta; // Referencia a la venta recién creada
    $detalle->id_producto = $id_producto; // ID del producto
    $detalle->cantidad = $item['cantidad']; // Cantidad del producto
    $detalle->precio = $item['precio']; // Precio del producto
    $detalle->subtotal = $item['precio'] * $item['cantidad']; // Calcula el subtotal
    $detalle->save(); // Guarda el detalle
}*/
        

    // Generar el PDF con el detalle del carrito
    $pdf = Pdf::loadView('vistas.recibo', compact('cart', 'subtotal', 'totalFinal', 'usuario', 'direccion', 'metodoEnvio', 'metodoPago', 'costoEnvioConIgv'));

    // Guardar el PDF
    $pdfPath = 'recibos/recibo_' . time() . '.pdf';
    $fullPdfPath = public_path($pdfPath);

    // Crea el directorio si no existe
    if (!file_exists(public_path('recibos'))) {
        mkdir(public_path('recibos'), 0755, true);
    }

    // Guarda el PDF en el sistema de archivos
    $pdf->save($fullPdfPath);

    // Limpia el carrito después del pago
    session()->forget('cart');

    return view('vistas.checkout', [
        'pdfUrl' => asset($pdfPath),
        'metodoPago' => $metodoPago
    ]);
}



   

public function updateCartQuantity(Request $request, $id_producto)
{
    $cart = session()->get('cart', []);
    if (isset($cart[$id_producto])) {
        $cart[$id]['cantidad'] = $request->input('quantity', 1); // Actualizar cantidad en sesión
        session()->put('cart', $cart);
    }
    return response()->json(['success' => true]);
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