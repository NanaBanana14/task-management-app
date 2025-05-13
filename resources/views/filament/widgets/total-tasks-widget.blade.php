<x-filament::widget>
    <x-filament::card wire:poll.5s>
        <div class="text-lg font-bold mb-4">Task Summary</div>

        <div class="flex flex-wrap gap-2 justify-center">
            <div class="p-6 rounded-xl shadow text-center">
                <div class="text-sm">Total</div>
                <div class="text-3xl font-bold">{{ $total }}</div>
            </div>

            <div class="p-6 rounded-xl shadow text-center">
                <div class="text-sm ">To Do</div>
                <div class="text-3xl font-bold">{{ $todo }}</div>
            </div>

            <div class="p-6 rounded-xl shadow text-center">
                <div class="text-sm">In Progress</div>
                <div class="text-3xl font-bold ">{{ $inProgress }}</div>
            </div>

            <div class="p-6 rounded-xl shadow text-center">
                <div class="text-sm ">Done</div>
                <div class="text-3xl font-bold ">{{ $done }}</div>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
