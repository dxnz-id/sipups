<?php

namespace App\Filament\Officer\Resources\UserResource\Pages;

use App\Filament\Officer\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
