<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;

    protected $table = 'tipo_usuario'; // Tabla de tipos de usuarios
    protected $primaryKey = 'id_tipo'; // Clave primaria
    protected $fillable = ['tipo']; // Campos asignables

    // Relación con los usuarios
    public function usuarios()
    {
        return $this->hasMany(User::class, 'tipo_usuario', 'id_tipo');
    }
}
