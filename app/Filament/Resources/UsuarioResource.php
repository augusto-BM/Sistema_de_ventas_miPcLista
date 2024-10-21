<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsuarioResource\Pages;
use App\Filament\Resources\UsuarioResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsuarioResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //Creamos el formulario para crear un usuario
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->label('Correo Electrónico')
                    ->email()
                    ->maxlength(255)
                    ->unique(ignoreRecord: true)
                    ->required(),
                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label('Correo verificado en')
                    ->default(now()),

                Forms\Components\TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nombre'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('Correo Electrónico'),

                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Correo verificado en'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Creado en'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Actualizado en'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                    ->label('Ver'),

                    Tables\Actions\EditAction::make()
                        ->label('Editar'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Eliminar'),
                ]),

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
            'index' => Pages\ListUsuarios::route('/'),
            'create' => Pages\CreateUsuario::route('/create'),
            'edit' => Pages\EditUsuario::route('/{record}/edit'),
        ];
    }
}
