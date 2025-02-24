<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getUser (): string
    {
        return User::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::count())
                ->descriptionIcon('heroicon-o-user-group', IconPosition::Before)
                ->description('Total number of users in the system.'),
            Stat::make('Books', Book::count())
                ->descriptionIcon('heroicon-o-book-open', IconPosition::Before)
                ->description('Total number of books in the system.'),
            Stat::make('Categories', Category::count())
                ->descriptionIcon('heroicon-o-rectangle-stack', IconPosition::Before)
                ->description('Total number of categories in the system.'),
        ];
    }
}
