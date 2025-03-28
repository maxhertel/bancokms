<?php

namespace App\Filament\Widgets;

use App\Models\Banco;
use App\Models\Cartao;
use App\Models\Cliente;
use App\Models\Estabelecimento;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
                Stat::make('Total de Bancos', Banco::count()),
                Stat::make('Total de Clientes', Cliente::count()),
                Stat::make('Total de Estabelecimentos', Estabelecimento::count()),
                Stat::make('Cartões Emitidos', Cartao::count()),
        ];
    }
}
