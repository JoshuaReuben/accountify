<x-resource-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Modules') }}
        </h2>
    </x-slot>


    <x-slot name="sidebarContent">
        <x-layouts.resource-sidebar-for-modules />
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">

                <div class="p-6 text-gray-900 uppercase dark:text-gray-100">

                    {{-- <livewire:course.course-table title="Choose a course to view its modules" /> --}}
                    @livewire('course.course-table', ['title' => 'Choose a course to view its modules'])

                </div>

            </div>
        </div>
    </div>

</x-resource-layout>
