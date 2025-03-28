<?php 
namespace App\Filament\Resources\BancoResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class CartoesRelationManager extends RelationManager
{
    protected static string $relationship = 'cartoes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero')
                    ->required()
                    ->maxLength(16),
                Forms\Components\DatePicker::make('validade')
                    ->required(),
                Forms\Components\Select::make('tipo')
                    ->options([
                        'debito' => 'Débito',
                        'credito' => 'Crédito',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('limite')
                    ->numeric()
                    ->prefix('AOA'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero'),
                Tables\Columns\TextColumn::make('tipo'),
                Tables\Columns\TextColumn::make('limite')->money('AOA'),
                Tables\Columns\TextColumn::make('validade'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}