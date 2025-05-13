<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Livewire\Livewire;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Manajemen Proyek';

    public static function canAccess(): bool
    {
        return Auth::check() && Auth::user()->hasAnyRole(['super_admin', 'Admin', 'Manager']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'todo' => 'To Do',
                        'in_progress' => 'In Progress',
                        'done' => 'Done',
                    ])
                    ->required(),
                
                Forms\Components\Select::make('priority')
                    ->label('Priority')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                    ])
                    ->required(),
                
                Forms\Components\DatePicker::make('due_date')
                    ->required(),

                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->required(),

                Forms\Components\Select::make('project_id')
                    ->label('Project')
                    ->options(Project::all()->pluck('name', 'id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(self::tableColumns())
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    public static function tableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('status')->searchable(),
            Tables\Columns\TextColumn::make('priority')->searchable(),
            Tables\Columns\TextColumn::make('due_date')->date()->sortable(),
            Tables\Columns\TextColumn::make('user.name')
                ->label('User')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('project.name')
                ->label('Project')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    public static function getRelations(): array
    {
        return [
            // Define relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
