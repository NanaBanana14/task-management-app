<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canAccess(): bool
    {
        return Auth::check() && Auth::user()->hasAnyRole(['super_admin', 'Admin',]);
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->hasRole('super_admin');
    }

    public static function canEdit($record): bool
    {
        return Auth::user()?->hasRole('super_admin');
    }

    public static function canDelete($record): bool
    {
        return Auth::user()?->hasRole('super_admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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

                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->required()
                    ->label('Roles'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('roles.name')
                    ->badge()
                    ->label('Roles'),

                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions(
                Auth::user()?->hasRole('super_admin')
                    ? [Tables\Actions\EditAction::make()]
                    : []
            )
            ->bulkActions(
                Auth::user()?->hasRole('super_admin')
                    ? [Tables\Actions\BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make(),
                    ])]
                    : []
            );
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
