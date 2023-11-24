<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Social') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Connect social services to use them in system.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            @if(auth()->user()->microsoftToken()->exists())
                <x-button 
                    type="button" 
                    class="bg-red-500"
                    wire:click="logout('microsoft')"
                    wire:loading.attr="disabled"
                >
                    {{ __('Logout From Microsoft') }}
                </x-button>
            @else
                <x-button 
                    type="button" 
                    wire:click="connect('microsoft')"
                    wire:loading.attr="disabled"
                    class="flex justify-between items-center"
                >
                    <img src="{{ asset('microsoft.png') }}" class="mr-1" width="15" alt="Microsoft">
                    <span>{{ __('Connect with Microsoft') }}</span>
                </x-button>
            @endif
        </div>
    </x-slot>
</x-form-section>
