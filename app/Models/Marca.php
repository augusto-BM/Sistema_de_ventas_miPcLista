<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
    use HasFactory;

    //Establecemos la tabla a la que hace referencia el modelo
    protected $fillable = ['nombre', 'identificador_url', 'imagen', 'es_activo'];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }
}
