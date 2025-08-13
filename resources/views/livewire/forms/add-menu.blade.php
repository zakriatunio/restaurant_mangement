<form wire:submit="submitForm">
    @csrf
    <div class="space-y-4">

        <x-help-text class="mb-6">@lang('modules.menu.menuNameHelp')</x-help-text>

        <!-- Language Selection -->
        @if(count($languages) > 1)
        <div class="mb-4">
            <x-label for="language" :value="__('modules.menu.selectLanguage')" />
            <x-select class="mt-1 block w-full" wire:model.live="currentLanguage">
            @foreach($languages as $code => $name)
                <option value="{{ $code }}">{{ $name }}</option>
            @endforeach
            </x-select>
        </div>
        @endif

        <!-- Menu Name with Translation -->
        <div class="mb-4">
            <x-label for="menuName" :value="__('modules.menu.menuName') . ' (' . $languages[$currentLanguage] . ')'" />
            <x-input id="menuName" class="block mt-1 w-full" type="text" placeholder="{{ __('placeholders.menuNamePlaceholder') }}" wire:model="menuName" wire:change="updateTranslation" />
            <x-input-error for="translations.{{ $globalLocale }}" class="mt-2" />
        </div>

        <!-- Translation Preview -->
        @if(count($languages) > 1 && array_filter($translations))
        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-2.5">
            <x-label :value="__('modules.menu.translations')" class="text-sm mb-2 last:mb-0" />
            <div class="divide-y divide-gray-200 dark:divide-gray-600">
                @foreach($translations as $lang => $text)
                @if(!empty($text))
                <div class="flex items-center gap-3 py-1.5">
                    <span class="min-w-[80px] text-xs font-medium text-gray-600 dark:text-gray-300">
                        {{ $languages[$lang] ?? strtoupper($lang) }}
                    </span>
                    <span class="flex-1 text-xs text-gray-700 dark:text-gray-200">{{ $text }}</span>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <div class="flex w-full pb-4 space-x-4 mt-6">
        <x-button>@lang('app.save')</x-button>
        <x-button-cancel  data-drawer-dismiss="drawer-create-product-default" aria-controls="drawer-create-product-default">@lang('app.cancel')</x-button-cancel>
    </div>
</form>
