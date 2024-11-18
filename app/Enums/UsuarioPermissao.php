<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum UsuarioPermissao: string implements HasLabel, HasColor, HasIcon {
    case admin = 'admin';
    case user = 'user';

    public function getLabel(): string {
        return match ($this) {
            self::admin => 'Administrador',
            self::user => 'Funcionário',
        };
    }

    public function getColor(): string {
        return match ($this) {
            self::admin => 'warning',
            self::user => 'info',
        };
    }

    public function getIcon(): ?string {
        return match ($this) {
            self::admin => 'heroicon-s-cog',
            self::user => 'heroicon-s-user',
        };
    }
}