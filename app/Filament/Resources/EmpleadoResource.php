<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmpleadoResource\Pages;
use App\Filament\Resources\EmpleadoResource\RelationManagers;
use App\Models\Ciudad;
use App\Models\Empleado;
use App\Models\Pais;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmpleadoResource extends Resource
{
    protected static ?string $model = Empleado::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Sistema';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('pais_id')
                    ->label('Paises')
                    ->options(Pais::all()->pluck('nombre', 'id')->toArray())
                    ->reactive(),
                Select::make('ciudad_id')
                    ->label('Ciudades')
                    ->options(Ciudad::all()->pluck('nombre', 'id')->toArray())
                    ->reactive(),
                TextInput::make('nombre'),
                TextInput::make('apellido'),
                Radio::make('casado')
                    ->options([
                        'si' => 'Si',
                        'No' => 'No',
                    ])->boolean(),
                TextInput::make('telefono')->numeric(),
                TextInput::make('correo')->email()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->label('nombre ')->sortable()->searchable(),
                TextColumn::make('apellido')->label('apellido '),
                TextColumn::make('casado')->label('casado '),
                TextColumn::make('telefono')->label('telefono '),
                TextColumn::make('correo')->label('correo ')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEmpleados::route('/'),
            'create' => Pages\CreateEmpleado::route('/create'),
            'edit' => Pages\EditEmpleado::route('/{record}/edit'),
        ];
    }
}
