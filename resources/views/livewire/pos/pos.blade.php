<div>

    <div class="flex-grow lg:flex h-auto">


        @include('pos.menu')
        @if (!$orderDetail)
            @include('pos.kot_items')
        @elseif($orderDetail->status == 'kot')
            @include('pos.order_items')
        @elseif($orderDetail->status == 'billed' || $orderDetail->status == 'paid')
            @include('pos.order_detail')
        @endif

    </div>

    <x-dialog-modal wire:model.live="showVariationModal" maxWidth="xl">
        <x-slot name="title">
            @lang('modules.menu.itemVariations')
        </x-slot>

        <x-slot name="content">
            @if ($menuItem)
            @livewire('pos.itemVariations', ['menuItem' => $menuItem], key(str()->random(50)))
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-button-cancel wire:click="$toggle('showVariationModal')" wire:loading.attr="disabled" />
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="showKotNote" maxWidth="xl">
        <x-slot name="title">
            @lang('modules.order.addNote')
        </x-slot>

        <x-slot name="content">
            <div>
                <x-label for="orderNote" :value="__('modules.order.orderNote')" />
                <x-textarea data-gramm="false"  class="block mt-1 w-full"  wire:model='orderNote' rows='2' />
                <x-input-error for="orderNote" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="$toggle('showKotNote')" wire:loading.attr="disabled">@lang('app.save')</x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="showTableModal" maxWidth="2xl">
        <x-slot name="title">
            @lang('modules.table.availableTables')
        </x-slot>

        <x-slot name="content">
            @livewire('pos.setTable')
        </x-slot>

        <x-slot name="footer">
            <x-button-cancel wire:click="$toggle('showTableModal')" wire:loading.attr="disabled" />
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="showDiscountModal" maxWidth="xl">
        <x-slot name="title">
            @lang('modules.order.addDiscount')
        </x-slot>

        <x-slot name="content">
            <div class="mt-4 flex">
                <!-- Discount Value -->
                <x-input id="discountValue" class="block w-2/3 text-md" type="number" step="0.01" wire:model.live="discountValue"
                    placeholder="{{ __('modules.order.enterDiscountValue') }}" min="0" />
                <!-- Discount Type -->
                <x-select id="discountType" class="block ml-2 w-1/3 rounded-md border-gray-300" wire:model.live="discountType">
                    <option value="fixed">@lang('modules.order.fixed')</option>
                    <option value="percent">@lang('modules.order.percent')</option>
                </x-select>
            </div>
        <x-input-error for="discountValue" class="mt-2" />
        </x-slot>

        <x-slot name="footer">
            <x-button-cancel wire:click="$set('showDiscountModal', false)">@lang('app.cancel')</x-button-cancel>
            <x-button class="ml-3" wire:click="addDiscounts" wire:loading.attr="disabled">@lang('app.save')</x-button>
        </x-slot>
    </x-dialog-modal>


    @if ($errors->count())
        <x-dialog-modal wire:model='showErrorModal' maxWidth="xl">
            <x-slot name="title">
                @lang('app.error')
            </x-slot>

            <x-slot name="content">
                <div class="space-y-3">
                    @foreach ($errors->all() as $error)
                        <div class="text-red-700 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                            </svg>
                            {{ $error }}
                        </div>
                    @endforeach
                </div>

            </x-slot>

            <x-slot name="footer">
                @if ($showNewKotButton)
                    <x-button class="me-2">
                        <a href="{{ route('pos.kot', ['id' => $orderDetail->id]) }}">
                            @lang('modules.order.newKot')
                        </a>
                    </x-button>
                @endif
                <x-button-cancel wire:click="closeErrorModal" wire:loading.attr="disabled" />
            </x-slot>
        </x-dialog-modal>
    @endif

    <x-dialog-modal wire:model.live="showModifiersModal" maxWidth="xl">
        <x-slot name="title">
            @lang('modules.modifier.itemModifiers')
        </x-slot>

        <x-slot name="content">
            @if ($selectedModifierItem)
                @livewire('pos.itemModifiers', ['menuItemId' => $selectedModifierItem], key(str()->random(50)))
            @endif
        </x-slot>
    </x-dialog-modal>

    @script
    <script>
        $wire.on('play_beep', () => {
            new Audio("{{ asset('sound/sound_beep-29.mp3')}}").play();
        });

        $wire.on('print_location', (url) => {
            const anchor = document.createElement('a');
            anchor.href = url;
            anchor.target = '_blank';
            anchor.click();
        });

    </script>
    @endscript

</div>
