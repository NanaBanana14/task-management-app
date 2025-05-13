<x-filament::widget>
    <x-filament::card>
        <div class="text-lg font-bold mb-4 text-center">Task Summary</div>

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

        <div class="text-lg font-bold my-6 text-center mt-2">Task Priority</div>

        <div class="flex flex-wrap gap-2 justify-center">
            <div class="p-6 rounded-xl shadow text-center">
                <div class="text-sm">Low</div>
                <div class="text-3xl font-bold" wire:poll.3s="getLowPriorityTasks">{{ $low }}</div>
            </div>

            <div class="p-6 rounded-xl shadow text-center">
                <div class="text-sm">Medium</div>
                <div class="text-3xl font-bold" wire:poll.3s="getMediumPriorityTasks">{{ $medium }}</div>
            </div>

            <div class="p-6 rounded-xl shadow text-center">
                <div class="text-sm">High</div>
                <div class="text-3xl font-bold" wire:poll.3s="getHighPriorityTasks">{{ $high }}</div>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
