<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusDespesa: string implements HasColor, HasLabel, HasIcon
{
    case paga = 'paga';
    case nao_paga = 'nao paga';

    public function getLabel(): string
    {
        return match ($this) {
            self::paga => 'Paga',
            self::nao_paga => 'Não Paga',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::paga => 'success',
            self::nao_paga => 'danger'
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::paga => 'heroicon-o-check-circle',
            self::nao_paga => 'heroicon-o-x-circle',
        };
    }
}