<?php

namespace App\Filament\Visitor\Resources\BookResource\Pages;

use App\Filament\Visitor\Resources\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ViewBook extends ListRecords
{
    protected static string $resource = BookResource::class;
}
