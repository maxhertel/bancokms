<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstabelecimentoResource\Pages;
use App\Filament\Resources\EstabelecimentoResource\RelationManagers;
use App\Models\Estabelecimento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EstabelecimentoResource extends Resource
{
    protected static ?string $model = Estabelecimento::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nif')
                    ->required()
                    ->maxLength(14)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('endereco')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telefone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Select::make('tipo')
                    ->options([
                        'loja' => 'Loja',
                        'restaurante' => 'Restaurante',
                        'supermercado' => 'Supermercado',
                        'servico' => 'Serviço',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nif')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefone')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipo')
                    ->options([
                        'loja' => 'Loja',
                        'restaurante' => 'Restaurante',
                        'supermercado' => 'Supermercado',
                        'servico' => 'Serviço',
                    ]),
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
            'index' => Pages\ListEstabelecimentos::route('/'),
            'create' => Pages\CreateEstabelecimento::route('/create'),
            'edit' => Pages\EditEstabelecimento::route('/{record}/edit'),
        ];
    }
}