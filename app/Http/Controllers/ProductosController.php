<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductosController extends Controller
{


    public function getPrecio($id_producto)
{
    $producto = Producto::find($id_producto);
    return response()->json(['precio' => $producto->precio]);

    if ($producto) {
        return response()->json(['precio' => $producto->getPrecio]); // Reemplaza 'precio' por el campo correcto de tu base de datos
    } else {
        return response()->json(['error' => 'Producto no encontrado'], 404);
    }

}



    // Listar todos los productos con su categoría
    public function index()
    {
        $productos = Producto::with('categoria')->get(); // Carga productos con su categoría
        $categorias = Categoria::all(); // Cargar todas las categorías para el select
        return view('vistas.productos.index', compact('productos','categorias' ));
        
    }

    // Mostrar formulario para crear un producto
    public function create()
    {
        $categorias = Categoria::all(); // Cargar todas las categorías para el select
        return view('vistas.productos.create', compact('categorias'));
    }

    // Guardar un nuevo producto
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'codigo' => 'required|max:255',
            'nombre' => 'required|max:50',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable|max:800',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validación de imagen
            'estado' => 'required|boolean',
            'id_categoria' => 'required|exists:categoria,id_categoria',
        ]);
    
        // Guardar la imagen si se ha subido
        $foto = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $foto = time() . '_' . $file->getClientOriginalName(); // Generar un nombre único
            $file->move(public_path('images'), $foto); // Mover la imagen a la carpeta public/images
        }
    
        // Crear el producto con la imagen
        Producto::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'descripcion' => $request->descripcion,
            'foto' => $foto, // Guardar el nombre de la imagen
            'estado' => $request->estado,
            'id_categoria' => $request->id_categoria,
        ]);
    
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }
    

    // Mostrar un producto específico
    public function show($id_producto)
    {
        //$producto = Producto::with('categoria')->findOrFail($id_producto); // Cargar producto con su categoría
        //return view('productos.show', compact('producto'));
       
{
    // Encuentra el producto por su ID
    $producto = Producto::find($id_producto);

    // Verifica si el producto existe
    if ($producto) {
        // Retorna el precio en formato JSON
        return response()->json(['precio' => $producto->precio]);
    } else {
        return response()->json(['error' => 'Producto no encontrado'], 404);
    }
}

    }

    // Mostrar formulario para editar un producto
    public function edit($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        $categorias = Categoria::all(); // Cargar categorías para el select
        return view('vistas.productos.edit', compact('productos', 'categorias'));
    }

    // Actualizar un producto
    public function update(Request $request, $id_producto)
    {
        // Validar los datos
        /*$request->validate([
            'codigo' => 'required|max:255',
            'nombre' => 'required|max:50',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable|max:255',
            'estado' => 'required|boolean',
            'id_categoria' => 'required|exists:categoria,id_categoria', // Validar que la categoría exista
        ]);*/

        // Encontrar el producto y actualizar
        $producto = Producto::findOrFail($id_producto);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    // Eliminar un producto
    public function destroy($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }

    public function buscar(Request $request)
{
    $query = $request->input('query');

    // Realiza la búsqueda en la base de datos
    $productos = Producto::where('nombre', 'LIKE', "%$query%")
                    ->orWhere('descripcion', 'LIKE', "%$query%")
                    ->get();

    // Retorna la vista con los resultados de búsqueda
    return view('vistas.resultados', compact('productos', 'query'));
}





}
?>