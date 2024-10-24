<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('vistas.clientes.index', compact('clientes'));
    }

    // Mostrar el formulario para crear un nuevo cliente
    public function create()
    {
        return view('vistas.clientes.create');
    }

    // Guardar un nuevo cliente en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|max:50',
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'telefono' => 'nullable|max:20',
            'direccion' => 'nullable|max:255',
            'correo' => 'nullable|email|max:255',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }

    // Mostrar un cliente específico
    public function show($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        return view('vistas.clientes.show', compact('cliente'));
    }

    // Mostrar el formulario para editar un cliente
    public function edit($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        return view('vistas.clientes.edit', compact('cliente'));
    }

    // Actualizar un cliente en la base de datos
    public function update(Request $request, $id_cliente)
    {
        $request->validate([
            'dni' => 'required|max:50',
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'telefono' => 'nullable|max:20',
            'direccion' => 'nullable|max:255',
            'correo' => 'nullable|email|max:255',
        ]);

        $cliente = Cliente::findOrFail($id_cliente);
        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    // Eliminar un cliente
    public function destroy($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
?>