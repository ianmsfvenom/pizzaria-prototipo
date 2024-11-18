<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TipoDespesa: string implements HasColor, HasLabel
{
    case conta_luz = 'conta de luz';
    case conta_agua = 'conta de agua';
    case pagamento_funcionario = 'pagamento de funcionario';
    case pagamento_aluguel = 'pagamento de aluguel';
    case pagamento_material = 'pagamento de material';
    case outros = 'outros';
    public function getLabel(): string
    {
        return match ($this) {
            self::conta_luz => 'Conta de Luz',
            self::conta_agua => 'Conta de Agua',
            self::pagamento_funcionario => 'Pagamento de Funcionários',
            self::pagamento_aluguel => 'Pagamento de Aluguel',
            self::pagamento_material => 'Pagamento de Material',
            self::outros => 'Outros',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::conta_luz => 'warning',
            self::conta_agua => 'info',
            self::pagamento_funcionario => 'success',
            self::pagamento_aluguel => 'success',
            self::pagamento_material => 'success',
            self::outros => 'danger',
        };
    }
}