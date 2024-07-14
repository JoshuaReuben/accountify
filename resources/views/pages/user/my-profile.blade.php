<x-app-layout>
    <x-slot name="header">
        <h2 class="mx-auto text-xl font-semibold leading-tight text-gray-800 max-w-7xl dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">


            {{-- Profile Photo --}}
            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-photo />
                </div>
            </div>


            {{-- Name And Email --}}
            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">

                    {{-- User --}}
                    <livewire:profile.update-profile-information-form />

                </div>
            </div>

            {{-- Password --}}
            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
