<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Filament\Resources\PedidoResource\RelationManagers;
use App\Filament\Resources\PedidoResource\RelationManagers\DireccionRelationManager;

use App\Models\Pedido;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Number;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;




class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Group::make()->schema([
                    Section::make('Informacion de Pedidos')->schema([
                        Select::make('user_id')
                            ->label('Cliente')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('metodo_pago')
                            ->label('Metodo de Pago')
                            ->options([
                                'stripe' => 'Stripe',
                                'pagoContraEntrega' => 'Pago contra entrega',
                            ])
                            ->required(),

                        Select::make('estado_pago')
                            ->label('Estado de Pago')
                            ->options([
                                'pendiente' => 'Pendiente',
                                'pagado' => 'Pagado',
                                'fallido' => 'Fallido'
                            ])
                            ->default('pendiente')
                            ->required(),

                        ToggleButtons::make('estado')
                            ->label('Estado del Pedido')
                            ->inline()
                            ->default('nuevo')
                            ->required()
                            ->options([
                                'nuevo' => 'Nuevo',
                                'en proceso' => 'Procesando',
                                'enviado' => 'Enviado',
                                'entregado' => 'Entregado',
                                'cancelado' => 'Cancelado',
                            ])
                            ->colors([
                                'nuevo' => 'info',
                                'en proceso' => 'warning',
                                'enviado' => 'success',
                                'entregado' => 'success',
                                'cancelado' => 'danger',
                            ])
                            ->icons([
                                'nuevo' => 'heroicon-m-sparkles',
                                'en proceso' => 'heroicon-m-arrow-path',
                                'enviado' => 'heroicon-m-truck',
                                'entregado' => 'heroicon-m-check-badge',
                                'cancelado' => 'heroicon-m-x-circle',
                            ]),

                        Select::make('moneda')
                            ->label('Moneda')
                            ->options([
                                'PEN' => 'Soles',
                                'USD' => 'Dolares'
                            ])
                            ->default('PEN')
                            ->required(),

                        Select::make('metodo_envio')
                            ->label('Metodo de Envio')
                            ->options([
                                'courier' => 'Courier',
                                'retiro' => 'Retiro en tienda',
                                'serpost' => 'Serpost',
                                'dhl' => 'DHL',
                                'fedex' => 'FedEx',
                                'ups' => 'UPS',
                                'rappi' => 'Rappi'
                            ]),
                        Textarea::make('notas')
                            ->label('Notas')
                            ->columnSpanFull()
                    ])->columns(2),

                    Section::make(('Informacion de Pedidos'))->schema([
                        Repeater::make('detallePedidos')
                        ->relationship()
                        ->schema([
                            Select::make('producto_id')
                                ->label('Producto')
                                ->relationship('producto', 'nombre')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->distinct()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->columnSpan(4)
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set) => $set('monto_unitario', Producto::find($state)?->precio ?? 0))

                                ->afterStateUpdated(fn ($state, Set $set) => $set('monto_total', Producto::find($state)?->precio ?? 0)),
                            
                            TextInput::make('cantidad')
                                ->label('Cantidad')
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->columnSpan(2)
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('monto_total', $state * $get ('monto_unitario'))),
                            
                            TextInput::make('monto_unitario')
                                ->label('Monto Unitario')
                                ->numeric()
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->columnSpan(3),

                            TextInput::make('monto_total')
                                ->label('Monto Total')
                                ->numeric()
                                ->required()
                                ->dehydrated()
                                /* ->disabled() */
                                ->columnSpan(3),
                        ])->columns(12),

                        Placeholder::make('total_pagar')
                            ->label('Total a Pagar')
                            ->content(function (Get $get, Set $set){

                                $total = 0;
                                if(!$repeaters = $get('detallePedidos')){
                                    return $total;
                                }

                                foreach($repeaters as $key => $repeater){
                                    $total += $get("detallePedidos.{$key}.monto_total");
                                }

                                $set('total_pagar', $total);
                                return Number::currency($total, $get('moneda'));
                            }),

                            Hidden::make('total_pagar')
                            ->default(0)

                    ])

                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('user.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('total_pagar')
                    ->label('Total a Pagar')
                    ->numeric()
                    ->sortable()
                    ->money('PEN'),
                
                TextColumn::make('metodo_pago')
                    ->label('Metodo de Pago')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('estado_pago')
                    ->label('Estado de Pago')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('moneda')
                    ->label('Moneda')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('metodo_envio')
                    ->label('Metodo de Envio')
                    ->searchable()
                    ->sortable(),
                
                SelectColumn::make('estado')
                    ->label('Estado del Pedido')
                    ->options([
                        'nuevo' => 'Nuevo',
                        'en proceso' => 'Procesando',
                        'enviado' => 'Enviado',
                        'entregado' => 'Entregado',
                        'cancelado' => 'Cancelado',
                    ])
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Fecha de Creacion')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('updated_at')
                    ->label('Ultima Actualizacion')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    
    public static function getNavigationBadgeColor(): string|array|null{
        return static::getModel()::count() > 10 ? 'success' : 'danger';
    }


    public static function getRelations(): array
    {
        return [
            //Despues de crear la realacion con la tabla Direccion con relationManager
            DireccionRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedido::route('/create'),
            'view' => Pages\ViewPedido::route('/{record}'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }
}
