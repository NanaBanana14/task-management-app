<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MyCommentResource\Pages;
use App\Models\Comment;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class MyCommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationGroup = 'My Project & Task';
    protected static ?string $navigationLabel = 'My Comments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('comments')
                    ->required()
                    ->label('Comment'),

                Forms\Components\Select::make('task_id')
                    ->label('Task')
                    ->options(
                        Task::where('user_id', Auth::id())->pluck('title', 'id')
                    )
                    ->required(),

                Forms\Components\Select::make('parent_id')
                    ->label('Reply to Comment')
                    ->options(
                        Comment::pluck('comments', 'id')
                    )
                    ->searchable()
                    ->nullable(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('comments')->label('Comment')->wrap(),
                Tables\Columns\TextColumn::make('task.title')->label('Task'),
                Tables\Columns\TextColumn::make('parent.comments')->label('Reply To')->limit(30),
                Tables\Columns\TextColumn::make('user.name')->label('User'),
            ])
            ->filters([])
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

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMyComments::route('/'),
            'create' => Pages\CreateMyComment::route('/create'),
            'edit' => Pages\EditMyComment::route('/{record}/edit'),
        ];
    }
}
