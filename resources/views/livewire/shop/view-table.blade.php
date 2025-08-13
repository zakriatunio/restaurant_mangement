<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            {{ $table->table_code }}
        </h3>
        <button wire:click="$dispatch('closeModal')" class="text-gray-400 hover:text-gray-500">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div class="space-y-4">
        <!-- Table Image -->
        @if($table->image)
            <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                <img src="{{ $table->image }}" alt="{{ $table->table_code }}" class="object-cover w-full h-full">
            </div>
        @endif

        <!-- Table Details -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">@lang('modules.table.seatingCapacity')</p>
                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $table->seating_capacity }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">@lang('modules.table.status')</p>
                <p class="mt-1 text-lg font-semibold">
                    <span @class([
                        'text-green-600' => $table->status == 'active',
                        'text-red-600' => $table->status == 'inactive'
                    ])>
                        @lang('modules.table.' . $table->status)
                    </span>
                </p>
            </div>
        </div>

        <!-- Table Description -->
        @if($table->description)
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">@lang('modules.table.description')</p>
                <p class="mt-1 text-gray-900 dark:text-white">{{ $table->description }}</p>
            </div>
        @endif
    </div>
</div> 