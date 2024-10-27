<?php

namespace App\Filament\Resources\PedidoResource\Widgets;

use App\Models\Pedido;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class PedidoEstadisticas extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            //Estadisicas de pedidos cuenta cuantos pedidos hay con el estado nuevo
            Stat::make('Nuevos Pedidos', Pedido::query()->where('estado', 'nuevo')->count()),
            
            //Estadisicas de pedidos cuenta cuantos pedidos hay con el estado proceso
            Stat::make('Pedidos en Proceso', Pedido::query()->where('estado', 'en proceso')->count()),

            //Estadisicas de pedidos cuenta cuantos pedidos hay con el estado entregado
            Stat::make('Pedidos Entregados', Pedido::query()->where('estado', 'entregado')->count()),

            //
            Stat::make('Precio Promedio', Number::currency(Pedido::query()->avg('total_pagar'), 'PEN')) 
        ];
    }
}
