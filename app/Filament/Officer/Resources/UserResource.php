<?php

namespace App\Filament\Officer\Resources;

use App\Filament\Officer\Resources\UserResource\Pages;
use App\Filament\Officer\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionServiceProvider;
use Spatie\Permission\Traits\HasRoles;
use function Laravel\Prompts\search;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Users';

    protected static ?string $navigationGroup = 'Access Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('name')
                ->label('Nama')
                ->disabled(),
            TextInput::make('email')
                ->label('Email')
                ->email()
                ->disabled(),
            Select::make('role')
                ->label('Role')
                ->options(Role::all()->pluck('name', 'name')) // Get roles from the database
                ->searchable()
                ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Username'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->colors([
                        'success' => 'administrator',
                        'warning' => 'officer',
                        'gray' => 'visitor',
                    ]),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Role')
                    ->multiple()
                    ->options([
                        'administrator' => 'Administrator',
                        'officer' => 'Officer',
                        'visitor' => 'Visitor',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label(false)
                ->icon(false),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}