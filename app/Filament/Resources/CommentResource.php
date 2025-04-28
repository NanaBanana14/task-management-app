<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

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
                Forms\Components\Select::make('task_id')
                    ->label('Task')
                    ->required()
                    ->options(
                        Task::query()
                            ->whereNotNull('title')
                            ->pluck('title', 'id')
                            ->toArray()
                    )
                    ->searchable(),
    
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->required()
                    ->options(
                        User::query()
                            ->whereNotNull('name')
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->searchable(),
    
                Forms\Components\Textarea::make('comments')
                    ->label('Comments')
                    ->required()
                    ->columnSpanFull(),
    
                Forms\Components\Select::make('parent_id')
                    ->label('Parent Comment')
                    ->options(
                        Comment::query()
                            ->whereNull('parent_id')
                            ->pluck('comments', 'id')
                            ->toArray()
                    )
                    ->searchable()
                    ->nullable(),
            ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('task.title')
                    ->label('Task')
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),

                Tables\Columns\TextColumn::make('parent.comments')
                    ->label('Parent Comment')
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
