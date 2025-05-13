<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Task;

class TaskStatusReportWidget extends Widget
{
    protected static string $view = 'filament.widgets.task-status-report-widget';

    public $todoCount;
    public $inProgressCount;
    public $doneCount;

    public function mount()
    {
        $user = auth()->user();

        $this->todoCount = Task::where('user_id', $user->id)->where('status', 'todo')->count();
        $this->inProgressCount = Task::where('user_id', $user->id)->where('status', 'in_progress')->count();
        $this->doneCount = Task::where('user_id', $user->id)->where('status', 'done')->count();
    }
}
