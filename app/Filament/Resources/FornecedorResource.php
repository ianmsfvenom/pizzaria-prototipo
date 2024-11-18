<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FornecedorResource\Pages;
use App\Filament\Resources\FornecedorResource\RelationManagers;
use App\Filament\Resources\FornecedorResource\RelationManagers\EstoquesRelationManager;
use App\Models\Fornecedor;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FornecedorResource extends Resource
{
    protected static ?string $model = Fornecedor::class;
    protected static ?string $modelLabel = 'Fornecedor';
    protected static ?string $pluralModelLabel = 'Fornecedores';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações da Instituição')
                    ->schema(static::getFornecedorFormSchema()),

                Section::make('Estoques')
                    ->schema([
                        static::getEstoquesFormSchema()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome da Instituição')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cpf_cnpj')
                    ->label('CPF/CNPJ')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tel')
                    ->label('Telefone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->searchable()
                    ->sortable()
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFornecedors::route('/'),
            'create' => Pages\CreateFornecedor::route('/create'),
            'edit' => Pages\EditFornecedor::route('/{record}/edit'),
        ];
    }

    public static function getFornecedorFormSchema(): array {
        return [
            TextInput::make('nome')
                    ->label('Nome da Instituição')
                    ->required()
                    ->maxLength(255),
                TextInput::make('cpf_cnpj')
                    ->label('CPF/CNPJ')
                    ->required()
                    ->maxLength(50),
                TextInput::make('tel')
                    ->label('Telefone')
                    ->required()
                    ->tel(),
                TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('whatsapp')
                    ->label('WhatsApp')
                    ->tel()
                    ->maxLength(255)
        ];
    }

    public static function getEstoquesFormSchema(): Repeater {
        return Repeater::make('estoques')
            ->relationship()
            ->label('Estoques')
            ->required()
            ->defaultItems(1)
            ->schema([
                Select::make('estoque_id')
                    ->relationship('estoque', 'material')
                    ->label('Estoque')
                    ->required()
            ]);
    }
}
