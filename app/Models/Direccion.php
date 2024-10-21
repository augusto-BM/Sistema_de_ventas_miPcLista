<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;


    //Establecemos la tabla a la que hace referencia el modelo
    protected $fillable = ['pedido_id', 'nombre', 'apellido', 'celular', 'direccion', 'ciudad', 'estado', 'codigo_postal'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }
}
