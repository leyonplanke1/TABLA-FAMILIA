<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Definir la tabla relacionada
    protected $table = 'cliente';

    // Definir la clave primaria
    protected $primaryKey = 'id_cliente';

    // Si no tienes timestamps en tu tabla
    public $timestamps = false;

    // Los campos que pueden ser asignados masivamente
    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'telefono',
        'direccion',
        'correo'
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_cliente', 'id_cliente');
    }


}
?>