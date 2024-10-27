<?php

namespace App\Filament\Resources\UsuarioResource\RelationManagers;

use App\Filament\Resources\PedidoResource;
use App\Models\Pedido;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PedidosRelationManager extends RelationManager
{
    protected static string $relationship = 'pedidos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                /* Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255), */
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                /* Tables\Columns\TextColumn::make('id'), */
                TextColumn::make('id')
                    ->label('ID Pedido')
                    ->searchable(),

                TextColumn::make('total_pagar')
                    ->money('PEN'),
                
                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'nuevo' => 'info',
                        'en proceso' => 'warning',
                        'enviado' => 'success',
                        'entregado' => 'success',
                        'cancelado' => 'danger',
                    })
                    ->icon(fn (string $state): string => match ($state) {
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
            ->filters([
                //
            ])
            ->headerActions([
               /*  Tables\Actions\CreateAction::make(), */
            ])
            ->actions([
                /* Tables\Actions\EditAction::make(), */
                Action::make('Ver Pedido')
                    ->url(fn (Pedido $record):string => PedidoResource::getUrl('view', ['record' => $record]))
                    ->color('info')
                    ->icon('heroicon-o-eye'),


                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
