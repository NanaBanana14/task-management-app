<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Widgets\Widget;

class TotalTasksWidget extends Widget
{
    protected static string $view = 'filament.widgets.total-tasks-widget';

    protected static bool $isLazy = false;

    protected int|string|array $columnSpan = 'full';

    public function getTotalTasks()
    {
        return Task::count();
    }

    public function getToDoTasks()
    {
        return Task::where('status', 'todo')->count();
    }

    public function getInProgressTasks()
    {
        return Task::where('status', 'in_progress')->count();
    }

    public function getDoneTasks()
    {
        return Task::where('status', 'done')->count();
    }

    public function getLowPriorityTasks()
    {
        return Task::where('priority', 'low')->count();
    }

    public function getMediumPriorityTasks()
    {
        return Task::where('priority', 'medium')->count();
    }

    public function getHighPriorityTasks()
    {
        return Task::where('priority', 'high')->count();
    }

    protected function getViewData(): array
    {
        return [
            'total' => $this->getTotalTasks(),
            'todo' => $this->getToDoTasks(),
            'inProgress' => $this->getInProgressTasks(),
            'done' => $this->getDoneTasks(),
            'low' => $this->getLowPriorityTasks(),
            'medium' => $this->getMediumPriorityTasks(),
            'high' => $this->getHighPriorityTasks(),
        ];
    }
}
