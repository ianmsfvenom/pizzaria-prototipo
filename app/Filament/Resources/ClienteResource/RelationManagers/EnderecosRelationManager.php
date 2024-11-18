<?php

namespace App\Filament\Resources\ClienteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnderecosRelationManager extends RelationManager
{
    protected static string $relationship = 'enderecos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cep')
                    ->label('CEP')
                    ->numeric()
                    ->required()
                    ->maxLength(8),
                Forms\Components\TextInput::make('logradouro')
                    ->label('Logradouro')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('numero')
                    ->label('Número')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bairro')
                    ->label('Bairro')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cidade')
                    ->label('Cidade')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('uf')
                    ->label('UF')
                    ->required()
                    ->maxLength(2),
                Forms\Components\TextInput::make('complemento')
                    ->label('Complemento')
                    ->required()
                    ->maxLength(255),
                    
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('logradouro')
            ->columns([
                Tables\Columns\TextColumn::make('logradouro'),
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
