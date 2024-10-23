<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';


    //Establecemos la tabla a la que hace referencia el modelo
    protected $fillable = ['pedido_id', 'nombre', 'apellido', 'celular', 'direccion', 'ciudad', 'estado', 'codigo_postal'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }
}
