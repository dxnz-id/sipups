<?php

namespace App\Filament\Officer\Resources\BookResource\Pages;

use App\Filament\Officer\Resources\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;
}
