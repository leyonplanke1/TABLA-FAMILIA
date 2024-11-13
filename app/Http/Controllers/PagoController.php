<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function procesarPago(Request $request)
    {
        $total = $request->total; // Asegúrate de enviar 'total' desde el formulario
        return view('paypal', compact('total'));
    }


    /*public function success(Request $request)
{
    // Logica para verificar el estado del pago con la API de PayPal
    // Puedes necesitar el Payment ID o algún token de PayPal que deberías retornar como parte de la URL

    $paymentId = $request->query('paymentId');
    $payerId = $request->query('PayerID');
    
    // Aquí se supone que tienes una lógica para validar el pago con PayPal
    $result = $this->validatePayment($paymentId, $payerId);

    if ($result->state == 'approved') {
        // Procesar la lógica de la orden como guardar en la base de datos, etc.
        // Mostrar una vista o redireccionar al usuario a una página de éxito
        return view('recibo.blade.php', ['result' => $result]);
    } else {
        // Lógica en caso de que PayPal no apruebe el pago
        return redirect()->route('payment.cancel');
    }
}


public function cancel(Request $request)
{
    // Opcionalmente guarda la cancelación en la base de datos o realiza otra lógica de negocio
    // Redirige al usuario a una página de cancelación o al carrito de compras
    return redirect()->route('cart.index')->with('error', 'El pago ha sido cancelado.');
}*/






}
