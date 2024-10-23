<?php

namespace App\Filament\Resources\PedidoResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class DireccionRelationManager extends RelationManager
{
    protected static string $relationship = 'Direccion';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                TextInput::make('apellido')
                    ->required()
                    ->maxLength(255),
                TextInput::make('celular')
                    ->required()
                    ->tel()
                    ->maxLength(20),
                TextInput::make('ciudad')
                    ->required()
                    ->maxLength(255),
                TextInput::make('estado')
                    ->required()
                    ->maxLength(255),
                TextInput::make('codigo_postal')
                    ->required()
                    ->numeric()
                    ->maxLength(10),

                Textarea::make('direccion')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('direccion')
            ->columns([
                TextColumn::make('nombre_completo') // usa el nombre del atributo
                    ->label('Nombre Completo'), // etiqueta que se mostrará en la interfaz
                TextColumn::make('celular'),
                TextColumn::make('ciudad'),
                TextColumn::make('estado'),
                TextColumn::make('codigo_postal'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
