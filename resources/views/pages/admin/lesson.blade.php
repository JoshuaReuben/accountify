<x-resource-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('LESSONS') }}
        </h2>
    </x-slot>


    <x-slot name="sidebarContent">
        <livewire:layout.resource-sidebar-for-lessons courseID="{{ $courseID }}" moduleID="{{ $moduleID }}" />
    </x-slot>



    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- <livewire:course.course-create /> --}}
                    <livewire:lesson.lesson-create courseID="{{ $courseID }}" moduleID="{{ $moduleID }}" />
                </div>
            </div>
        </div>
    </div>


    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- <livewire:course.course-table /> --}}
                </div>
            </div>
        </div>
    </div>


</x-resource-layout>
