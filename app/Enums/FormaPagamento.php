<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum FormaPagamento: string implements HasLabel, HasIcon, HasColor {

    case dinheiro = 'dinheiro';
    case debito = 'débito';
    case credito = 'crédito';
    case pix = 'pix';

    public function getLabel(): string {
        return match ($this) {
            self::dinheiro => 'Dinheiro',
            self::debito => 'Débito',
            self::credito => 'Crédito',
            self::pix => 'Pix',
        };
    }

    public function getColor(): string | array | null {
        return match ($this) {
            self::dinheiro => 'success',
            self::debito => 'danger',
            self::credito => 'warning',
            self::pix => 'info',
        };
    }

    public function getIcon(): ?string {
        return match ($this) {
            self::dinheiro => 'heroicon-m-banknotes',
            self::debito => 'heroicon-m-credit-card',
            self::credito => 'heroicon-m-credit-card',
            self::pix => 'heroicon-m-qr-code',
        };
    }
}
