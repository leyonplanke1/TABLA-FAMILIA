<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{


   

    
    // Listar todas las categorías
    public function index()
    {
        $categorias = Categoria::all(); // Obtener todas las categorías
        return view('vistas.categorias.index', compact('categorias'));
    }

    // Mostrar formulario para crear una categoría
    public function create()
    {
        
        return view('categorias.create');
    }

    // Guardar una nueva categoría
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:100',
            
            'descripcion' => 'required|max:100',
        ]);

        // Crear la categoría
        Categoria::create($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    // Mostrar formulario para editar una categoría
    public function edit($id_categoria)
    {
        $categoria = Categoria::findOrFail($id_categoria); // Encontrar la categoría
        return view('categorias.edit', compact('categoria'));
    }

    // Actualizar una categoría
    public function update(Request $request, $id_categoria)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:100',
            'descripcion' => 'nullable|max:255',
        ]);

        // Encontrar y actualizar la categoría
        $categoria = Categoria::findOrFail($id_categoria);
        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    // Eliminar una categoría
    public function destroy($id_categoria)
    {
        $categoria = Categoria::findOrFail($id_categoria); // Encontrar la categoría
        $categoria->delete(); // Eliminarla

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
