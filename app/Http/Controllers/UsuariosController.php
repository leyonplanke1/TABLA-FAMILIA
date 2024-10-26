<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Venta;

class UsuariosController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return view('vistas.usuarios.index', compact('usuarios'));
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        return view('vistas.usuarios.create');
    }

    // Guardar un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        // Validar los campos recibidos
        $request->validate([
            'usuario' => 'required|unique:usuario|max:100', // Validación de usuario único
            'tipo_usuario' => 'required|in:1,2',  // Solo valores 1 (Admin) o 2 (Cliente)
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'dni' => 'required|numeric|digits:8|unique:usuario,dni', // Nuevo campo DNI con validación
            'password' => 'required|min:5|max:255',
            'telefono' => 'nullable|max:20',
            'direccion' => 'nullable|max:255',
            'correo' => 'required|email|max:255',
            'estado' => 'required|boolean',
        ]);

        // Crear el usuario con los datos recibidos
        Usuario::create([
            'usuario' => $request->usuario,
            'tipo_usuario' => $request->tipo_usuario,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni, // Guardar DNI
            'password' => bcrypt($request->password),
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'correo' => $request->correo,
            'estado' => $request->estado,
        ]);

        // Redirigir al index con mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    // Mostrar un usuario específico
    public function show($id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);
        return view('vistas.usuarios.show', compact('usuario'));
    }

    // Mostrar el formulario para editar un usuario
    public function edit($id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);
        return view('vistas.usuarios.edit', compact('usuario'));
    }

    // Actualizar un usuario en la base de datos
    public function update(Request $request, $id_usuario)
    {
        $request->validate([
            'usuario' => 'required|max:100|unique:usuario,usuario,' . $id_usuario . ',id_usuario',
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'dni' => 'required|numeric|digits:8|unique:usuario,dni,' . $id_usuario . ',id_usuario', // Validación de DNI
            'password' => 'nullable|min:8|max:255',
            'telefono' => 'nullable|max:20',
            'direccion' => 'nullable|max:255',
            'correo' => 'nullable|email|max:255',
            'estado' => 'required|boolean',
        ]);

        $usuario = Usuario::findOrFail($id_usuario);
        $data = $request->all();

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Eliminar un usuario
    public function destroy($id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);

        // Elimina todas las ventas asociadas al usuario
        $usuario->ventas()->delete();

        // Elimina el usuario
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario y sus ventas eliminados correctamente.');
    }
}
?>
