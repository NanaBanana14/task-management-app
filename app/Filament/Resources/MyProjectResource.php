<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MyProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextLinkColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MyProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'My Project & Task';
    protected static ?string $navigationLabel = 'Project + Member';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Project Name')
                    ->disabled(),  // Disable for edit
                Forms\Components\TextInput::make('description')
                    ->label('Description')
                    ->disabled(),  // Disable for edit
                Forms\Components\DatePicker::make('start_date')
                    ->label('Start Date')
                    ->disabled(),  // Disable for edit
                Forms\Components\DatePicker::make('end_date')
                    ->label('End Date')
                    ->disabled(),  // Disable for edit
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'planning' => 'Planning',
                        'ongoing' => 'Ongoing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Project Name')
                    ->searchable()
                    ->sortable()
                    ->size('lg'),
                TextColumn::make('description')
                    ->limit(50)
                    ->label('Description')
                    ->size('sm'),
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->size('sm')
                    ->date(),
                TextColumn::make('end_date')
                    ->label('End Date')
                    ->size('sm')
                    ->date(),
                TextColumn::make('status')
                    ->label('Status')
                    ->size('sm'),
                TextColumn::make('members')
                    ->label('Project Members')
                    ->getStateUsing(function (Project $record) {
                        return $record->members->map(function ($member) {
                            return $member->user->name . ' (' . $member->role_in_project . ')';
                        })->implode(', ');
                    })
                    ->size('sm')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([])  // Add any filters if needed
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([]);  // Remove bulk actions
    }
    

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('users', function ($query) {
                $query->where('user_id', Auth::id());
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMyProjects::route('/'),
            'edit' => Pages\EditMyProject::route('/{record}/edit'),
        ];
    }
}
