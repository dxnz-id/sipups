<?php

namespace App\Filament\Visitor\Resources\BookResource\Pages;

use App\Filament\Visitor\Resources\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;
}
