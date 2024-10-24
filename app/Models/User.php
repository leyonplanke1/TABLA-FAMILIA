<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuario'; // Indicamos el nombre de la tabla en la BD
    protected $primaryKey = 'id_usuario'; // Indicamos la clave primaria

    public $timestamps = false; // Desactivar timestamps automáticos

    protected $fillable = [
        'nombre',
        'apellido',
        'usuario',
        'password',
        'telefono',
        'direccion',
        'correo',
        'foto',
        'estado',
        'tipo_usuario', // Este campo se usará para identificar el rol
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function tipo()
    {
        return $this->belongsTo(TipoUsuario::class, 'tipo_usuario', 'id_tipo');
    }


    // Método para verificar el rol del usuario
    public function esAdmin()
    {
        return $this->tipo_usuario === 1; // 1 para administrador
    }

    public function esCliente()
    {
        return $this->tipo_usuario === 2; // 2 para cliente
    }
}
