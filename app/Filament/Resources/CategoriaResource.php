<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Filament\Resources\CategoriaResource\RelationManagers;
use App\Models\Categoria;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    //Orden del sidebar menu de navegacion aparece tercero
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /* Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('identificador_url')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('imagen'),
            Forms\Components\Toggle::make('es_activo')
                ->required(), */
                Section::make([
                    Grid::make()
                        ->schema([
                            TextInput::make('nombre')
                                ->label('Nombre')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('identificador_url', Str::slug($state)) : null),

                            TextInput::make('identificador_url')
                                ->label('Identificador URL')
                                ->maxLength(255)
                                ->disabled()
                                ->required()
                                ->dehydrated()
                                ->unique(Categoria::class, 'identificador_url', ignoreRecord: true)
                        ]),

                    FileUpload::make('imagen')
                        ->label('Imagen')
                        ->image()
                        ->required()
                        ->directory('categorias'),

                    Toggle::make('es_activo')
                        ->label('Activo')
                        ->required()
                        ->default(true)
                ])


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('imagen')
                    ->searchable(),
                Tables\Columns\TextColumn::make('identificador_url')
                    ->searchable(),
                Tables\Columns\IconColumn::make('es_activo')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creacion')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ultima Actualizacion')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                /* Tables\Actions\EditAction::make(), */
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'edit' => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }
}
