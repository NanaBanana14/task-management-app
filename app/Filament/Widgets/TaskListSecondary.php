<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Filament\Resources\TaskResource;
use Illuminate\View\View;

class TaskListSecondary extends BaseWidget
{
    protected static bool $isLazy = false;
    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder|Relation|null
    {
        return Task::query()->with(['user', 'project']);
    }

    protected function getTableColumns(): array
    {
        return TaskResource::tableColumns();
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ];
    }

    public function render(): View
    {
        return view('filament.widgets.task-list-secondary');
    }
}
