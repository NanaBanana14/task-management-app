<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\TotalTasksWidget;
use App\Filament\Widgets\TaskListSecondary;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TotalTasksWidget::class,
            TaskListSecondary::class,
        ];
    }
}
