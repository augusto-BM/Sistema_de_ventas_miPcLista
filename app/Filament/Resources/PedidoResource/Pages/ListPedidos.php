<?php

namespace App\Filament\Resources\PedidoResource\Pages;

use App\Filament\Resources\PedidoResource;
use App\Filament\Resources\PedidoResource\Widgets\PedidoEstadisticas;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListPedidos extends ListRecords
{
    protected static string $resource = PedidoResource::class;

    //Establecemos el titulo de la pagina
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    //Establecemos los widgets que se mostraran en la pagina
    protected function getHeaderWidgets(): array
    {
        return [
            PedidoEstadisticas::class
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Todo'),
            'nuevo' => Tab::make()->query(fn($query) => $query->where('estado', 'nuevo')),
            'en proceso' => Tab::make()->query(fn($query) => $query->where('estado', 'en proceso')),
            'enviado' => Tab::make()->query(fn($query) => $query->where('estado', 'enviado')),
            'entregado' => Tab::make()->query(fn($query) => $query->where('estado', 'entregado')),
            'cancelado' => Tab::make()->query(fn($query) => $query->where('estado', 'cancelado')),
        ];
    }
}
