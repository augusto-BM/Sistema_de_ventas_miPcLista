<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;

    //Establecemos la tabla a la que hace referencia el modelo
    protected $fillable = ['category_id', 'marcas_id', 'nombre', 'identificador_url', 'imagen', 'descripcion', 'precio', 'es_activo', 'es_destacado', 'en_stock', 'en_oferta'];

    protected $casts = [
        'imagen' => 'array',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marcas_id');
    }

    public function detallePedido()
    {
        return $this->hasMany(DetallePedido::class);
    }
}
