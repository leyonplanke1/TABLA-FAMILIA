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
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PagoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí registramos las rutas de la aplicación.
|
*/

Route::get('/', function () {
    return redirect()->route("welcome");
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/buscar', [ProductosController::class, 'buscar'])->name('buscar');



Route::get('/logout', function () {
    Auth::logout();
    return redirect('/welcome'); // Redirige a la página welcome
})->name('logout');



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

    Route::resource('usuarios', UsuariosController::class);

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
    Route::post('/cart/checkout', [ProductosTiendaController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/update/{id_producto}', [ProductosTiendaController::class, 'updateCartQuantity'])->name('cart.updateQuantity');

    

    Route::post('/procesar-pago', [PagoController::class, 'procesarPago'])->name('procesar.pago');
    

// Define las rutas para los procesos de éxito y cancelación de pagos
//Route::post('/payment-success', [PagoController::class, 'success'])->name('payment.success');
//Route::post('/payment-cancel', [PagoController::class, 'cancel'])->name('payment.cancel');






    Route::get('/view-pdf/{pdfPath}', function ($pdfPath) {
        $filePath = public_path($pdfPath);
    
        // Verificar si el archivo existe
        if (file_exists($filePath)) {
            return response()->file($filePath);
        }
    
        return abort(404);
    })->name('pdf.view');
    


    Route::post('/contacto/enviar', [ContactController::class, 'sendContactForm'])->name('contact.send');


  



    

  



    
   

    
});
