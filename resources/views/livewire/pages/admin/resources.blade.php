<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Course;

new #[Layout('layouts.admin')] class extends Component {
    public $courses;

    public function mount()
    {
        $this->courses = Course::all();
    }
};

?>



<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Resources') }}
        </h2>
    </x-slot>

    {{-- START - Section  1 --}}
    <div class="py-6">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">


                {{-- Container of Table --}}
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                    {{-- Table --}}
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{-- THEAD --}}
                        <div class="text-xs text-gray-700 uppercase ">
                            {{-- TR --}}
                            <div class="flex justify-between ">
                                {{-- Table Row Head --}}
                                <div
                                    class="px-6 py-3  w-[500px] min-w-[500px]  bg-gray-50 dark:bg-gray-700 dark:text-gray-400 grow">
                                    Course Name
                                </div>
                                <div
                                    class="px-6 py-3  w-[250px] min-w-[250px] text-center bg-gray-50 dark:bg-gray-700 dark:text-gray-400 grow">
                                    No. of Course Exam Question
                                </div>
                                <div
                                    class="px-6 py-3  w-[150px] min-w-[150px] text-center bg-gray-50 dark:bg-gray-700 dark:text-gray-400 grow">
                                    No. of Modules
                                </div>
                                <div
                                    class="px-6 py-3  w-[150px] min-w-[150px] text-center bg-gray-50 dark:bg-gray-700 dark:text-gray-400 grow">
                                    Publish Status
                                </div>
                                <div
                                    class="px-6 py-3  w-[150px] min-w-[150px] text-center bg-gray-50 dark:bg-gray-700 dark:text-gray-400 grow">
                                    Visit Course
                                </div>
                                <div
                                    class="px-6 py-3  w-[100px] min-w-[100px] text-center pr-5 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 grow">
                                    Toggle
                                </div>
                            </div>

                        </div>

                        {{-- TBODY --}}
                        <div x-data="resourcesTableSetup()" class="flex flex-col">

                            {{-- Course Table Loop --}}
                            @forelse ($courses as $course)
                                {{-- Row - Course --}}

                                {{-- TR - 1st Row --}}
                                <div wire:key="tr-1-course-{{ $course->id }}"
                                    class="flex items-center justify-between bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                    {{-- Course Name --}}
                                    <div
                                        class="grow w-[500px] min-w-[500px] px-6 py-4 font-medium text-lg text-gray-900 dark:text-white">
                                        {{ $loop->iteration }}. {{ $course->course_name }}
                                    </div>

                                    {{-- No. of Course Exam Question --}}
                                    <div class="grow text-center w-[250px] min-w-[250px] px-6 py-4">
                                        {{ $course->courseQuestions()->count() }}
                                    </div>

                                    {{-- No. of Modules --}}
                                    <div class="grow text-center w-[150px] min-w-[150px] px-6 py-4">
                                        {{ $course->modules()->count() }}
                                    </div>

                                    {{-- Publish Status --}}
                                    <div class="grow text-center w-[150px] min-w-[150px] px-6 py-4">
                                        {{ $course->course_publish_date ? $course->course_publish_date : 'Not Published' }}
                                    </div>

                                    {{-- Visit Course --}}
                                    <div class="grow text-center w-[150px] min-w-[150px] px-6 py-4">
                                        <a href="{{ route('pages.admin.course.show', $course->id) }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            Visit Course
                                        </a>
                                    </div>

                                    {{-- Toggle Chevron Icon of Course --}}
                                    <div class="grow text-center  w-[100px] min-w-[100px] px-6 py-4 pr-5">
                                        <button type="button" @click="toggleCourse({{ $course->id }})"
                                            class="text-white  bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-800">
                                            {{-- Chevron Icon --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke-width="2" stroke="currentColor"
                                                class="inline-block transition size-5 shrink-0" aria-hidden="true"
                                                :class="expandedCourseID == {{ $course->id }} ? 'rotate-180' : ''">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </div>

                                </div>

                                {{-- TR - 2nd Row --}}
                                <div x-cloak wire:key="tr-2-course-{{ $course->id }}"
                                    x-show="expandedCourseID == {{ $course->id }}"
                                    class="w-full h-full px-6 py-4 border border-gray-500 darkborder-gray-500 bg-gray-950">
                                    {{-- ------------------------------------------------------------------------------------- --}}
                                    {{-- Start Container Table for Modules --}}



                                    @forelse ($course->modules as $module)
                                        <h2
                                            class="my-2 text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                                            Module {{ $loop->iteration }}:
                                        </h2>
                                        <div class="mb-10">
                                            <div
                                                class="w-full overflow-x-auto border divide-y divide-slate-300 rounded-xl border-slate-300 bg-slate-100/40 text-slate-700 dark:divide-slate-700 dark:border-slate-700 dark:bg-slate-800/50 dark:text-slate-300">


                                                <div wire:key="module-{{ $module->id }}" x-data="{ isExpanded: false, moduleExpanded: false }"
                                                    class="divide-y divide-slate-300 dark:divide-slate-700">
                                                    {{-- Module Table --}}
                                                    <div class="overflow-x-auto">
                                                        <table
                                                            class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                                                            <thead
                                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                                <tr>
                                                                    <th scope="col" class="px-6 py-3">
                                                                        Module Name
                                                                    </th>
                                                                    <th scope="col" class="px-6 py-3 text-center">
                                                                        Module Exam Question Count
                                                                    </th>
                                                                    <th scope="col" class="px-6 py-3 text-center">
                                                                        Created Lessons Count
                                                                    </th>
                                                                    <th scope="col" class="px-6 py-3 text-center">
                                                                        Toggle
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr
                                                                    class="bg-white border-b-8 dark:bg-gray-800 dark:border-gray-700">
                                                                    <td
                                                                        class="px-6 py-4 w-[500px] min-w-[500px] max-w-[500px] font-bold text-white">
                                                                        {{ $module->module_name }}
                                                                    </td>
                                                                    <td
                                                                        class="px-6 py-4 font-bold text-center text-white">
                                                                        {{ $module->moduleQuestions()->count() }}
                                                                    </td>
                                                                    <td
                                                                        class="px-6 py-4 font-bold text-center text-white">
                                                                        {{ $module->lessons()->count() }}
                                                                    </td>
                                                                    <td
                                                                        class="px-6 py-4 font-bold text-center text-white">
                                                                        <button type="button"
                                                                            @click="moduleExpanded = ! moduleExpanded"
                                                                            :aria-expanded="moduleExpanded ? 'true' : 'false'"
                                                                            class="text-white  bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-700 dark:border-gray-800"
                                                                            :class="moduleID == xxxx ? 'ml-auto' : ''">
                                                                            {{-- Expand or Hide Contents --}}
                                                                            <span x-show="!moduleExpanded">Expand
                                                                                Contents</span>
                                                                            <span x-show="moduleExpanded">Hide
                                                                                Contents</span>
                                                                            {{-- Chevron Icon --}}
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke-width="2" stroke="currentColor"
                                                                                class="inline-block ml-2 transition size-5 shrink-0"
                                                                                aria-hidden="true"
                                                                                :class="moduleExpanded ? 'rotate-180' : ''">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                                            </svg>
                                                                        </button>
                                                                    </td>
                                                                </tr>

                                                                {{-- Lessons --}}
                                                                @forelse ($module->lessons as $lesson)
                                                                    <tr x-show="moduleExpanded"
                                                                        class="bg-white border-t dark:bg-gray-800 dark:border-gray-700">

                                                                        <td
                                                                            class="px-6 py-4 w-[500px] min-w-[500px] max-w-[500px] ">
                                                                            <strong class="font-bold text-white">
                                                                                Lesson {{ $loop->iteration }}:
                                                                            </strong> {{ $lesson->lesson_title }}
                                                                        </td>

                                                                        <td class="px-6 py-4 ">
                                                                            <strong class="font-bold text-white">
                                                                                Created Question Count:
                                                                            </strong>
                                                                            {{ $lesson->questions()->count() }}
                                                                        </td>

                                                                        <td class="px-6 py-4 ">
                                                                            <strong class="font-bold text-white">
                                                                                Flashcards Count:
                                                                            </strong>
                                                                        </td>

                                                                        <td class="px-6 py-4 text-center">
                                                                            <a href="{{ route('pages.admin.lesson.show', ['courseID' => $course->id, 'moduleID' => $module->id, 'lessonID' => $lesson->id]) }}"
                                                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                                                Visit Lesson
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @empty
                                                                    <tr x-show="moduleExpanded">
                                                                        <td colspan="4"
                                                                            class="px-6 py-4 italic text-center">
                                                                            No Lesson Added
                                                                        </td>
                                                                    </tr>
                                                                @endforelse


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-6 italic text-center text-gray-900 dark:text-gray-100">
                                            <p>No Modules Added.</p>
                                        </div>
                                    @endforelse

                                    {{-- End Container Table for Modules -- --}}
                                </div>



                            @empty
                                <div class="p-6 italic text-center text-gray-900 dark:text-gray-100">
                                    <p>No Courses Added.</p>
                                </div>
                            @endforelse


                        </div>

                    </div>
                </div>

                {{-- END - Section 1 --}}
            </div>
        </div>
    </div>


    <script>
        function resourcesTableSetup() {
            return {
                expandedCourseID: null,
                moduleID: null,
                lessonID: null,
                toggleCourse(courseID) {
                    this.expandedCourseID = this.expandedCourseID === courseID ? null : courseID;
                }
            }
        }
    </script>

</div>
