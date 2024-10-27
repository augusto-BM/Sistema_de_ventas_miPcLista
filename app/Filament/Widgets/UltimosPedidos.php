<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\PedidoResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use App\Models\Pedido;
use Filament\Tables\Actions\Action;

class UltimosPedidos extends BaseWidget
{

    //para que se muestre en la vista ampliada los ultimos pedidos
    protected int | string | array $columnSpan = 'full';

    //para que se muestre en la vista ampliada al inicio los pedidos estadisticas
    protected static ?int $sort = 2;


    public function table(Table $table): Table
    {
        return $table
            ->query(PedidoResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('ID Pedido')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Usuario')
                    ->searchable(),

                TextColumn::make('total_pagar')
                    ->money('PEN'),

                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'nuevo' => 'info',
                        'en proceso' => 'warning',
                        'enviado' => 'success',
                        'entregado' => 'success',
                        'cancelado' => 'danger',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'nuevo' => 'heroicon-m-sparkles',
                        'en proceso' => 'heroicon-m-arrow-path',
                        'enviado' => 'heroicon-m-truck',
                        'entregado' => 'heroicon-m-check-badge',
                        'cancelado' => 'heroicon-m-x-circle',
                    })
                    ->sortable(),

                TextColumn::make('metodo_pago')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('estado_pago')
                    ->sortable()
                    ->badge()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime()
            ])

            ->actions([
                Action::make('Ver Pedido')
                    ->url(fn (Pedido $record):string => PedidoResource::getUrl('view', ['record' => $record]))
                    ->color('info')
                    ->icon('heroicon-o-eye'),
            ]);
    }
}
