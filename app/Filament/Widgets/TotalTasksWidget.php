<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Widgets\Widget;

class TotalTasksWidget extends Widget
{
    protected static string $view = 'filament.widgets.total-tasks-widget';

    protected int|string|array $columnSpan = 'full';

    protected function getViewData(): array
    {
        return [
            'total' => Task::count(),
            'todo' => Task::where('status', 'todo')->count(),
            'inProgress' => Task::where('status', 'in_progress')->count(),
            'done' => Task::where('status', 'done')->count(),
        ];
    }


    protected static bool $isLazy = false; // Agar langsung load
}
