<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendContactForm(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'mensaje' => 'required|string',
        ]);

        // Datos del correo
        $data = [
            'nombre' => $request->nombre,
            'email' => $request->email,
            'mensaje' => $request->mensaje,
        ];

         // Intentar enviar el correo
    try {
        Mail::send('emails.contact', $data, function($message) use ($data) {
            $message->to('evacalderoninga3@gmail.com', 'Tu Nombre')
                    ->subject('Nuevo mensaje de contacto');
        });

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Correo enviado correctamente.');

    } catch (\Exception $e) {
        // Redireccionar con mensaje de error
        return redirect()->back()->with('error', 'Hubo un error al enviar el correo: ' . $e->getMessage());
    }

}
}