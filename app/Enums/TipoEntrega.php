<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TipoEntrega: string implements HasLabel, HasIcon, HasColor {

    case entrega = 'Delivery';
    case retirada = 'Retirada';

    public function getLabel(): string {
        return match ($this) {
            self::entrega => 'Delivery',
            self::retirada => 'Retirada',
        };
    }

    public function getColor(): string | array | null {
        return match ($this) {
            self::entrega => 'success',
            self::retirada => 'info',
        };
    }

    public function getIcon(): ?string {
        return match ($this) {
            self::entrega => 'heroicon-m-truck',
            self::retirada => 'heroicon-m-building-storefront',
        };
    }
}