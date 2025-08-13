<div>
    <form wire:submit="submitForm">
        @csrf
        <div class="space-y-4">

            <div>
                <x-label for="memberName" value="{{ __('modules.staff.name') }}" />
                <x-input id="memberName" class="block mt-1 w-full" type="text" autofocus wire:model='memberName' />
                <x-input-error for="memberName" class="mt-2" />
            </div>

            <div>
                <x-label for="memberEmail" value="{{ __('modules.staff.email') }}" />
                <x-input id="memberEmail" class="block mt-1 w-full" type="email" autofocus wire:model='memberEmail' />
                <x-input-error for="memberEmail" class="mt-2" />
            </div>

            @if ($member->id != auth()->id())
            <div>
                <x-label for="memberRole" value="{{ __('app.role') }}" />

                <x-select  class="mt-1 block w-full" wire:model='memberRole'>
                    @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ __('modules.staff.'.$role->display_name) }}</option>
                    @endforeach
                </x-select>

                <x-input-error for="memberRole" class="mt-2" />
            </div>
            @endif

        </div>

        <div class="flex w-full pb-4 space-x-4 mt-6">
            <x-button>@lang('app.save')</x-button>
            <x-button-cancel  wire:click="$dispatch('hideEditStaff')" wire:loading.attr="disabled">@lang('app.cancel')</x-button-cancel>
        </div>
    </form>
</div>
