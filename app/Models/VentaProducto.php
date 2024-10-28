<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaProducto extends Model
{
    use HasFactory;

    protected $table = 'venta_detalle'; // Tabla en la base de datos
    protected $fillable = ['id_venta', 'id_producto', 'cantidad', 'precio', 'descuento','subtotal']; // Campos que pueden ser asignados masivamente
    protected $primaryKey = 'id_venta_detalle';
    public $timestamps = false;

    // Relación con Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    // Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    


}
