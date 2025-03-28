<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartaoResource\Pages;
use App\Filament\Resources\CartaoResource\RelationManagers;
use App\Models\Banco;
use App\Models\Cliente;
use App\Models\Cartao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CartaoResource extends Resource
{
    protected static ?string $model = Cartao::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('cliente_id')
                    ->label('Cliente')
                    ->options(Cliente::all()->pluck('nome', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('banco_id')
                    ->label('Banco')
                    ->options(Banco::all()->pluck('nome', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('numero')
                    ->required()
                    ->maxLength(16)
                    ->unique(ignoreRecord: true),
                Forms\Components\DatePicker::make('validade')
                    ->required(),
                Forms\Components\TextInput::make('cvv')
                    ->required()
                    ->maxLength(3),
                Forms\Components\Select::make('tipo')
                    ->options([
                        'debito' => 'Débito',
                        'credito' => 'Crédito',
                        'prepago' => 'Pré-pago',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('limite')
                    ->numeric()
                    ->prefix('AOA'),
                Forms\Components\TextInput::make('saldo')
                    ->numeric()
                    ->prefix('AOA')
                    ->default(0),
                Forms\Components\Select::make('estado')
                    ->options([
                        'ativo' => 'Ativo',
                        'bloqueado' => 'Bloqueado',
                        'cancelado' => 'Cancelado',
                    ])
                    ->default('ativo')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente.nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('banco.nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo'),
                Tables\Columns\TextColumn::make('limite')
                    ->money('AOA'),
                Tables\Columns\TextColumn::make('saldo')
                    ->money('AOA'),
                Tables\Columns\TextColumn::make('estado'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipo')
                    ->options([
                        'debito' => 'Débito',
                        'credito' => 'Crédito',
                        'prepago' => 'Pré-pago',
                    ]),
                Tables\Filters\SelectFilter::make('estado')
                    ->options([
                        'ativo' => 'Ativo',
                        'bloqueado' => 'Bloqueado',
                        'cancelado' => 'Cancelado',
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
            'index' => Pages\ListCartaos::route('/'),
            'create' => Pages\CreateCartao::route('/create'),
            'edit' => Pages\EditCartao::route('/{record}/edit'),
        ];
    }
}