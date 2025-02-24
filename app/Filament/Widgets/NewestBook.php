<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class NewestBook extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 3;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Book::query()->latest()->limit(4)
            )
            ->columns([
                Stack::make([
                    ImageColumn::make('cover')
                        ->label('Cover')
                        ->width(250)
                        ->height(400)
                        ->tooltip(fn($record) => $record->title . ' - ' . $record->author),
                    // TextColumn::make('title')
                    //     ->label('Title')
                    //     ->extraAttributes(['class' => 'font-bold'])
                    //     ->searchable()
                    //     ->sortable()
                ])


            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->actions([
                ViewAction::make()->label(false)->icon(false)->slideOver(),
            ])
            ->contentGrid([
                'sm' => 1,
                'md' => 3,
                'xl' => 4,
            ])
            ->paginated(false);
    }
}
