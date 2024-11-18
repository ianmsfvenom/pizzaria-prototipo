<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PedidoStatus: string implements HasColor, HasIcon, HasLabel
{
    case pendente = 'pendente';
    case aprovado = 'aprovado';
    case cancelado = 'cancelado';

    public function getLabel(): string
    {
        return match ($this) {
            self::pendente => 'Pendente',
            self::aprovado => 'Aprovado',
            self::cancelado => 'Cancelado'
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::pendente => 'warning',
            self::aprovado => 'success',
            self::cancelado => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::pendente => 'heroicon-m-clock',
            self::aprovado => 'heroicon-m-check',
            self::cancelado => 'heroicon-m-x-mark'
        };
    }
}