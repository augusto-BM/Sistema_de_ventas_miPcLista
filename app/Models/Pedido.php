<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    
    //Establecemos la tabla a la que hace referencia el modelo
    protected $fillable = ['user_id', 'total_pagar', 'metodo_pago', 'estado_pago', 'estado', 'moneda', 'monto_envio', 'metodo_envio', 'notas']; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class);
    }

    public function direccion()
    {
        return $this->hasOne(Direccion::class);
    }


}
