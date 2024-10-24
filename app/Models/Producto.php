<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'codigo',
        'nombre',
        'precio',
        'stock',
        'descripcion',
        'estado',
        'id_categoria'
    ];

    // Relación con Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function ventaProductos()
    {
        return $this->hasMany(VentaProducto::class, 'id_producto', 'id_producto');
    }



}

?>
