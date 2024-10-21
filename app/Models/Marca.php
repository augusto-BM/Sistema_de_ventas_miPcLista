<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    //Establecemos la tabla a la que hace referencia el modelo
    protected $fillable = ['nombre', 'identificador_url', 'imagen', 'es_activo'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
