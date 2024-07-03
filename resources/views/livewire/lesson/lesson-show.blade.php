<div>
    <x-slot name="header">
        <div class="flex justify-between w-full">
            <div class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('LESSON  ') }}{{ $lesson_position . ' | ' . $passed_lesson->lesson_title }}
            </div>
            <div>
                {{-- Back to Courses --}}
                <a href="{{ route('pages.admin.course.show', $courseID) }}"
                    class=" focus:outline-none text-white font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">
                    &nbsp; <i class="text-2xl fa-solid fa-xmark"></i>
                </a>
            </div>
        </div>

    </x-slot>


    <x-slot name="sidebarContent">
        <livewire:layout.resource-sidebar-for-lessons courseID="{{ $courseID }}" moduleID="{{ $moduleID }}" />
    </x-slot>



    <div class="pt-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-auto shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">

                    {{-- Action Buttons --}}
                    <div class="flex justify-end">
                        {{-- Create Questions --}}
                        <a href="{{ route('pages.admin.question', ['courseID' => $courseID, 'moduleID' => $moduleID, 'lessonID' => $passed_lesson->id]) }}"
                            class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Create Questions &nbsp; <i class="fa-solid fa-plus"></i>
                        </a>


                        {{-- Edit --}}
                        <a href="{{ route('pages.admin.lesson.edit', [$courseID, $moduleID, $passed_lesson->id]) }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Edit Lesson &nbsp; <i class="fa-solid fa-pencil"></i>
                        </a>

                        {{-- Delete --}}
                        <button type="button" wire:confirm="Are you sure you want to delete this Lesson?"
                            wire:click="deleteLesson({{ $passed_lesson->id }})"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Delete Lesson &nbsp; <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>



                </div>
            </div>
        </div>
    </div>


    <div class="pt-2 pb-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-x-auto bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div id="lesson-show-container" class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <h1 class="my-4 text-xl font-bold uppercase">Lesson {{ $lesson_position }}:
                            {{ $passed_lesson->lesson_title }}</h1>
                    </div>
                    {!! $passed_lesson->lesson_content !!}

                </div>
            </div>
        </div>
    </div>



</div>
