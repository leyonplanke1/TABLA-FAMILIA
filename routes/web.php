<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ProductosTiendaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmpresaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí registramos las rutas de la aplicación.
|
*/

Route::get('/', function () {
    return redirect()->route("home");
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






/* Registro */
Route::get('/register/admin', [RegisterController::class, 'showAdminRegistrationForm'])->name('register.admin');
Route::post('/register/admin', [RegisterController::class, 'registerAdmin'])->name('register.admin');

Route::get('/register/cliente', [RegisterController::class, 'showRegistrationForm'])->name('register.cliente');
Route::post('/register/cliente', [RegisterController::class, 'register'])->name('register.cliente');

/* Rutas para Administradores */
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/tienda', function () {
        return view('tienda.index');
    })->name('tienda.index');


    Route::resource('clientes', ClientesController::class);
    Route::resource('productos', ProductosController::class);
    Route::resource('categorias', CategoriasController::class);
    Route::resource('ventas', VentasController::class);

    // Empresa
    Route::get('empresa-index', [EmpresaController::class, 'index'])->name('empresa.index')->middleware('verified');
    Route::post('empresa-update-{id}', [EmpresaController::class, 'update'])->name('empresa.update')->middleware('verified');
});

/* Rutas Generales */
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/nosotros', function () {
    return view('vistas.nosotros');
})->name('nosotros');

Route::get('/contacto', function () {
    return view('vistas.contacto');
})->name('contacto');

Route::get('/tienda', [ProductosTiendaController::class, 'index'])->name('tienda.index');

/* Rutas para Clientes */
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/cart', [ProductosTiendaController::class, 'cart'])->name('cart.index');
    Route::post('/cart/add/{id_producto}', [ProductosTiendaController::class, 'addToCart'])->name('cart.add');
    Route::get('/remove-from-cart/{id_producto}', [ProductosTiendaController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/clear-cart', [ProductosTiendaController::class, 'clearCart'])->name('cart.clear');

    
});
