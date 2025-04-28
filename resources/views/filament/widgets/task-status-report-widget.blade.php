@php
    $totalCount = $todoCount + $inProgressCount + $doneCount;
@endphp

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <x-filament::card>
        <div class="flex items-center space-x-2">

            <div>
                <div class="text-xs font-semibold text-blue-500 uppercase">Todo</div>
                <div class="text-2xl font-bold">{{ $todoCount }}</div>
            </div>
        </div>
        <div class="mt-3">
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $totalCount ? ($todoCount/$totalCount*100) : 0 }}%"></div>
            </div>
        </div>
    </x-filament::card>

    <x-filament::card>
        <div class="flex items-center space-x-2">
            <div>
                <div class="text-xs font-semibold text-orange-500 uppercase">In Progress</div>
                <div class="text-2xl font-bold">{{ $inProgressCount }}</div>
            </div>
        </div>
        <div class="mt-3">
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-yellow-600 h-2.5 rounded-full" style="width: {{ $totalCount ? ($inProgressCount/$totalCount*100) : 0 }}%"></div>
            </div>
        </div>
    </x-filament::card>

    <x-filament::card>
        <div class="flex items-center space-x-2">
            <div>
                <div class="text-xs font-semibold text-green-500 uppercase">Done</div>
                <div class="text-2xl font-bold">{{ $doneCount }}</div>
            </div>
        </div>
        <div class="mt-3">
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $totalCount ? ($doneCount/$totalCount*100) : 0 }}%"></div>
            </div>
        </div>
    </x-filament::card>
</div>
