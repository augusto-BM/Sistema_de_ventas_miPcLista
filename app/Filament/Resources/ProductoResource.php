<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Producto;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    //Orden del sidebar menu de navegacion aparece cuarto
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                //Seccion de la informacion del producto
                Group::make()->schema([
                    Section::make('Informacion del Producto')->schema([
                        TextInput::make('nombre')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('identificador_url', Str::slug($state)) : null),

                        TextInput::make('identificador_url')
                            ->label('Identificador URL')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated() //
                            ->unique(Producto::class, 'identificador_url', ignoreRecord: true),

                        MarkdownEditor::make('descripcion')
                            ->label('Descripcion')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('produtos'),
                    ])->columns(2),

                    Section::make('imagen')->schema([
                        FileUpload::make('imagen')
                            ->Label('Imagenes')
                            ->multiple()
                            ->directory('productos')
                            ->maxFiles(5)
                            ->reorderable()
                    ])
                ])->columnSpan(2),

                //Seccion de la informacion del precio
                Group::make()->schema([
                    Section::make('Informacion de Precio')->schema([
                        TextInput::make('precio')
                            ->label('Precio')
                            ->numeric()
                            ->required()
                            ->prefix('PEN')
                    ]),

                    Section::make('Asociaciones')->schema([
                        Select::make('category_id')
                            ->label('Categoria')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('categoria', 'nombre'),

                        Select::make('marcas_id')
                            ->label('Marca')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('marca', 'nombre')
                    ]),

                    Section::make('Estado')->schema([
                        Toggle::make('en_stock')
                            ->label('En Stock')
                            ->required()
                            ->default(true),

                        Toggle::make('es_activo')
                            ->label('Activo')
                            ->required()
                            ->default(true),

                        Toggle::make('es_destacado')
                            ->label('Destacado')
                            ->required()
                            ->default(false),
                        Toggle::make('en_oferta')
                            ->label('En Oferta')
                            ->required()
                            ->default(false),
                    ]),

                ])
                    ->columnSpan(1)

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->searchable(),
                TextColumn::make('categoria.nombre')
                    ->sortable(),
                TextColumn::make('marca.nombre')
                    ->sortable(),
                TextColumn::make('precio')
                    ->money('PEN')
                    ->sortable(),
                IconColumn::make('es_destacado')
                    ->boolean(),
                IconColumn::make('en_oferta')
                    ->boolean(),
                IconColumn::make('en_stock')
                    ->boolean(),
                IconColumn::make('es_activo')
                    ->boolean(),
                
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('categoria')
                ->relationship('categoria', 'nombre'),
                SelectFilter::make('marca')
                ->relationship('marca', 'nombre')
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




    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
