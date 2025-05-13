<x-filament::widget>
    <x-filament::card>
        <div class="text-lg font-bold mb-4">Task Summary</div>

        <div class="flex flex-wrap gap-2 justify-center">
            <div class="p-6 rounded-xl shadow text-center">
                <div class="text-sm">Total</div>
                <div class="text-3xl font-bold" wire:poll.3s="getTotalTasks">{{ $total }}</div>
            </div>

            <div class="p-6 rounded-xl shadow text-center">
                <div class="text-sm">To Do</div>
                <div class="text-3xl font-bold" wire:poll.3s="getToDoTasks">{{ $todo }}</div>
            </div>

            <div class="p-6 rounded-xl shadow text-center">
                <div class="text-sm">In Progress</div>
                <div class="text-3xl font-bold" wire:poll.3s="getInProgressTasks">{{ $inProgress }}</div>
            </div>

            <div class="p-6 rounded-xl shadow text-center">
                <div class="text-sm">Done</div>
                <div class="text-3xl font-bold" wire:poll.3s="getDoneTasks">{{ $done }}</div>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
