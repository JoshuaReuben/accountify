<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('LESSON  ') }}{{ $lesson_position . ' | ' . $passed_lesson->lesson_title }}
        </h2>
    </x-slot>


    <x-slot name="sidebarContent">
        <livewire:layout.resource-sidebar-for-lessons courseID="{{ $courseID }}" moduleID="{{ $moduleID }}" />
    </x-slot>



    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-auto bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                </div>
            </div>
        </div>
    </div>


    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-x-auto bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div id="lesson-show-container" class="p-6 text-gray-900 dark:text-gray-100">
                    {!! $passed_lesson->lesson_content !!}

                </div>
            </div>
        </div>
    </div>



</div>
