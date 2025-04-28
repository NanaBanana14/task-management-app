<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MyTaskResource\Pages;
use App\Models\Task;
use App\Models\SubTask;
use App\Models\User;
use App\Models\Project;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MyTaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'My Project & Task';
    protected static ?string $navigationLabel = 'Task + Sub-Task + Comments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->disabled(),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull()
                    ->disabled(),

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
                    ->disabled(),

                Forms\Components\DatePicker::make('due_date')
                    ->required()
                    ->disabled(),

                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->required()
                    ->disabled(),

                Forms\Components\Select::make('project_id')
                    ->label('Project')
                    ->options(Project::all()->pluck('name', 'id'))
                    ->required()
                    ->disabled(),

                Forms\Components\Repeater::make('subTasks')
                    ->relationship('subTasks')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'todo' => 'To Do',
                                'in_progress' => 'In Progress',
                                'done' => 'Done',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('due_date')
                            ->required(),
                    ])
                    ->columns(1)
                    ->createItemButtonLabel('Tambah Subtask'),

                    Forms\Components\Section::make('Comments')
                    ->schema([
                        Forms\Components\Placeholder::make('comments_list')
                            ->content(function ($record) {
                                if (!$record) return 'No comments yet.';

                                $comments = Comment::where('task_id', $record->id)
                                    ->whereNull('parent_id') 
                                    ->with(['user'])
                                    ->get();

                                if ($comments->isEmpty()) {
                                    return 'No comments yet.';
                                }
                
                                return $comments->map(function ($comment) {
                                    return $comment->user->name . ': ' . $comment->comments;
                                })->implode("\n");
                            })
                            ->columnSpanFull()
                            ->disableLabel(),
                    ])
                    ->collapsed(),                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.name')->label('Project')->searchable(),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('status')->searchable(),
                Tables\Columns\TextColumn::make('priority')->searchable(),
                Tables\Columns\TextColumn::make('due_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('subTasks.title')
                    ->label('Subtasks')
                    ->searchable()
                    ->getStateUsing(fn(Task $record) => $record->subTasks->pluck('title')->implode(', ')),

                Tables\Columns\TextColumn::make('comments')
                    ->label('Comments')
                    ->getStateUsing(function (Task $record) {
                        $comments = Comment::where('task_id', $record->id)
                            ->whereNull('parent_id')
                            ->with('user')
                            ->get();

                        if ($comments->isEmpty()) {
                            return 'No comments yet.';
                        }

                        return $comments->map(function ($comment) {
                            return '<strong>' . e($comment->user->name) . ':</strong> ' . e($comment->comments);
                        })->implode('<br>');
                    })
                    ->html()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('project_id')
                    ->label('Project')
                    ->options(Project::all()->pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', Auth::id());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMyTasks::route('/'),
            'edit' => Pages\EditMyTask::route('/{record}/edit'),
        ];
    }
}
