<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectMemberResource\Pages;
use App\Models\ProjectMember;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Model;

class ProjectMemberResource extends Resource
{
    protected static ?string $model = ProjectMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Manajemen Proyek';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required()
                    ->label('Project'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('User'),
                Forms\Components\TextInput::make('role_in_project')
                    ->required()
                    ->maxLength(255)
                    ->label('Role in Project'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->label('Project Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('role_in_project')
                    ->label('Role')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('project_id')
                    ->relationship('project', 'name')
                    ->label('Project'),
                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjectMembers::route('/'),
            'create' => Pages\CreateProjectMember::route('/create'),
            'edit' => Pages\EditProjectMember::route('/{record}/edit'),
        ];
    }
}
