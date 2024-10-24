<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'usuario'; //este es el nombre del campo de la tabla
    }

    protected function credentials(Request $request)
{
    return [
        'usuario' => $request->get('usuario'),
        'password' => $request->get('password'),
    ];
}


protected function redirectTo()
{
    if (auth()->user()->tipo_usuario == 1) {
        return '/home'; // Redirige al panel del administrador
    }

    return '/welcome'; // Redirige al área del cliente
}

// Este método se ejecuta después de que un usuario se autentica
protected function authenticated(Request $request, $user)
{
    // Redirigir según el rol del usuario
    if ($user->esAdmin()) {
        return redirect()->route('home'); // Cambia 'admin.dashboard' a la ruta de tu panel de admin
    } elseif ($user->esCliente()) {
        return redirect()->route('welcome'); // Cambia 'client.dashboard' a la ruta de tu interfaz de cliente
    }

    // Por defecto, redirige a una ruta general
    return redirect()->intended('welcome'); // Cambia 'home' a tu ruta deseada
}


public function logout(Request $request)
{
    Auth::logout(); // Cierra la sesión
    return redirect('/welcome'); // Redirige a la página principal o la que prefieras
}



}
