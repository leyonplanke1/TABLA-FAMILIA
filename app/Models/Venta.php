<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'venta'; // Tabla en la base de datos
    protected $primaryKey = 'id_venta';
    protected $fillable = ['id_cliente', 'fecha', 'total', 'descuento', 'pagoTotal']; // Campos que pueden ser asignados masivamente
    public $timestamps = false;

    // Relación con VentaProducto
    public function productos()
    {
        return $this->hasMany(VentaProducto::class, 'id_venta');
    }

    public function ventaProductos()
    {
        return $this->hasMany(VentaProducto::class, 'id_venta'); // 'id_venta' es la columna FK en la tabla venta_productos
    }


    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

}
