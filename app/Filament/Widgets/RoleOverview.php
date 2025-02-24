<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RoleOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    protected function getStats(): array
    {
        return [
            Stat::make('Administrators', User::where('role', 'administrator')->count()),
            Stat::make('Officers', User::where('role', 'officer')->count()),
            Stat::make('Visitor', User::where('role', 'visitor')->count()),
        ];
    }
}
