<?php

namespace App\Filament\Resources;

use App\Enums\StatusDespesa;
use App\Enums\TipoDespesa;
use App\Filament\Resources\DespesaResource\Pages;
use App\Filament\Resources\DespesaResource\RelationManagers;
use App\Models\Despesa;
use Filament\Forms;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DespesaResource extends Resource
{
    protected static ?string $model = Despesa::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-down';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required(),
                ToggleButtons::make('tipo')
                    ->options(TipoDespesa::class)
                    ->inline()
                    ->required(),
                ToggleButtons::make('status')
                    ->options(StatusDespesa::class)
                    ->inline()
                    ->required(),
                Forms\Components\Textarea::make('descricao')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('valor')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('data_pagamento')
                    ->label('Data de Pagamento')
                    ->required(),
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('valor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_pagamento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),
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
            'index' => Pages\ListDespesas::route('/'),
            'create' => Pages\CreateDespesa::route('/create'),
            'edit' => Pages\EditDespesa::route('/{record}/edit'),
        ];
    }
}
