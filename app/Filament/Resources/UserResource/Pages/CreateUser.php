<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),

            Forms\Components\DateTimePicker::make('email_verified_at'),

            Forms\Components\TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => \Hash::make($state))
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('roles')
                ->options([
                    'admin' => 'Admin/Manager',
                    'staff' => 'Staff'
                ])
                ->multiple()
                ->required()
                ->label('Roles'),
        ];
    }
}
