<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubTaskResource\Pages;
use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SubTaskResource extends Resource
{
    protected static ?string $model = SubTask::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationGroup = 'Manajemen Proyek';

    public static function canAccess(): bool
    {
        return Auth::check() && Auth::user()->hasAnyRole(['super_admin', 'Admin', 'Manager']);
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('task_id')
                    ->label('Task')
                    ->options(Task::all()->pluck('title', 'id'))
                    ->required(),
                
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\Textarea::make('description')
                    ->nullable(),
                
                Forms\Components\Select::make('status')
                    ->options([
                        'todo' => 'To Do',
                        'in_progress' => 'In Progress',
                        'done' => 'Done',
                    ])
                    ->required(),
                
                Forms\Components\DatePicker::make('due_date')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('task.title')->label('Task'),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('status')->searchable(),
                Tables\Columns\TextColumn::make('due_date')->date(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->filters([
                // 
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // 
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubTasks::route('/'),
            'create' => Pages\CreateSubTask::route('/create'),
            'edit' => Pages\EditSubTask::route('/{record}/edit'),
        ];
    }
}
