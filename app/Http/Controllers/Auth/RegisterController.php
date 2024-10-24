<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    // Redirección basada en el tipo de usuario
    protected function redirectTo()
    {
        if (auth()->user()->tipo_usuario == 1) {
            return '/admin'; // Redirige al panel del administrador
        }

        return '/tienda'; // Redirige al cliente a la tienda
    }

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Validación de datos comunes para registro
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'usuario' => ['required', 'string', 'max:50', 'unique:usuario'],
            'correo' => ['required', 'string', 'email', 'max:100', 'unique:usuario'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // Crear un usuario con los datos proporcionados
    protected function create(array $data)
    {
        return User::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'usuario' => $data['usuario'],
            'password' => Hash::make($data['password']),
            'telefono' => $data['telefono'] ?? null,
            'direccion' => $data['direccion'] ?? null,
            'correo' => $data['correo'],
            'foto' => $data['foto'] ?? null,
            'estado' => 1, // Activo por defecto
            'tipo_usuario' => $data['tipo_usuario'], // Tipo de usuario (Cliente o Administrador)
        ]);
    }

    // Registro para clientes
    public function register(Request $request)
    {
        $this->validator($request->all())->validate(); // Validar los datos

        $user = $this->create($request->all()); // Crear el usuario

        auth()->login($user); // Iniciar sesión automáticamente

        return redirect($this->redirectTo())->with('success', 'Cliente registrado exitosamente.'); // Redirigir con éxito
    }

    // Registro para administradores
    public function registerAdmin(Request $request)
    {
        $this->validator($request->all())->validate(); // Validar los datos

        $user = $this->create($request->all()); // Crear el usuario
        $user->tipo_usuario = 1; // Asignar tipo 1 para administrador
        $user->save(); // Guardar el usuario

        auth()->login($user); // Iniciar sesión automáticamente

        return redirect('/admin')->with('success', 'Administrador registrado exitosamente.'); // Redirigir al panel de admin
    }

    // Mostrar formulario de registro de clientes
    public function showRegistrationForm()
    {
        return view('auth.register-cliente'); // Vista del cliente
    }

    // Mostrar formulario de registro de administradores
    public function showAdminRegistrationForm()
    {
        return view('auth.register-admin'); // Vista del administrador
    }
}
