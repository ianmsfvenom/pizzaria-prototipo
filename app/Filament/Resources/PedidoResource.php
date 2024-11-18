<?php

namespace App\Filament\Resources;

use App\Enums\FormaPagamento;
use App\Enums\Pedido\PedidoStatus as PedidoPedidoStatus;
use App\Enums\PedidoStatus;
use App\Enums\TipoEntrega;
use App\Filament\Resources\PedidoResource\Pages;
use App\Filament\Resources\PedidoResource\RelationManagers;
use App\Models\Endereco;
use App\Models\Pedido;
use App\Models\Produto;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações do Pedido')
                    ->schema(static::getFormSchema1()),
                Section::make('Itens do pedido')
                    ->schema([
                        static::getFormSchema2()
                    ])
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('N° do Pedido')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo_entrega')
                    ->label('Tipo de Entrega')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('forma_pagamento')
                    ->label('Forma de Pagamento')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('cliente.nome')
                    ->label('Cliente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('endereco.logradouro')
                    ->label('Endereço')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedido::route('/create'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }

    public static function getFormSchema1(): array {
        return [
            Forms\Components\ToggleButtons::make('tipo_entrega')
                ->label('Tipo de Entrega')
                ->inline()
                ->options(TipoEntrega::class)
                ->required(),
            Forms\Components\ToggleButtons::make('forma_pagamento')
                ->label('Forma de Pagamento')
                ->inline()
                ->options(FormaPagamento::class)
                ->required(),
                
            Forms\Components\ToggleButtons::make('status')
                ->inline()
                ->options(PedidoStatus::class)
                ->required(),

            Forms\Components\Select::make('cliente_id')
                ->label('Cliente')
                ->relationship('cliente', 'nome')
                ->required()
                ->searchable()
                ->reactive()
                ->afterStateUpdated(function (Set $set, Get $get) {
                    $clienteId = $get('cliente_id');
                    $enderecos = Endereco::where('cliente_id', $clienteId)->get();
                    $options = $enderecos->pluck('logradouro', 'id')->toArray();
                    $set('endereco_id', null);
                    $set('endereco_id_options', $options);
                }),
            Forms\Components\Select::make('endereco_id')
                ->label('Endereço')
                ->required()
                ->options(function (Get $get) {
                    return $get('endereco_id_options');
                })
                ->searchable()
                ->live()
        ];
    }

    public static function getFormSchema2(): Repeater {
        return Repeater::make('produtos')
            ->relationship()
            ->label('Produtos')
            ->required()
            ->defaultItems(1)
            ->schema([
                Select::make('produto_id')
                    ->label('Produto')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, Set $set) => $set('preco_unitario', Produto::find($state)?->preco_unitario ?? 0))
                    ->options(Produto::all()->mapWithKeys(function ($produto) {
                        return [$produto->id => $produto->nome . " - " . $produto->tamanho];
                    }))
                    ->searchable(),
                TextInput::make('quantidade')
                    ->label('Quantidade')
                    ->numeric()
                    ->integer()
                    ->required(),
                TextInput::make('preco_unitario')
                    ->disabled()
                    ->dehydrated()
                    ->numeric()
                    ->required()
                    ->live()
            ]);
    }
        
}
