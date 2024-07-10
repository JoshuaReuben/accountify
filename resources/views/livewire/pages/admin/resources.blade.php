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

    {{-- 0 Section --}}
    <div class="py-6">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                {{-- Start Section 0 --}}

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
                                    class="flex justify-between bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                    {{-- Course Name --}}
                                    <div
                                        class="grow w-[500px] min-w-[500px] px-6 py-4 font-medium text-gray-900 dark:text-white">
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
                                    asdf
                                </div>



                            @empty
                                <div class="p-6 italic text-center text-gray-900 dark:text-gray-100">
                                    <p>No Courses Added.</p>
                                </div>
                            @endforelse


                        </div>

                    </div>
                </div>

                {{-- End Section 0 --}}
            </div>
        </div>
    </div>




    {{-- 2nd Section --}}

    <div class="py-6">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">

                <div class="p-6 text-gray-900 uppercase dark:text-gray-100">

                    {{-- Start Resource --}}


                    <div
                        class="w-full overflow-hidden border divide-y divide-slate-300 rounded-xl border-slate-300 bg-slate-100/40 text-slate-700 dark:divide-slate-700 dark:border-slate-700 dark:bg-slate-800/50 dark:text-slate-300">

                        @forelse ($courses as $course)
                            <div wire:key="course-{{ $course->id }}" x-data="{ isExpanded: false }"
                                class="divide-y divide-slate-300 dark:divide-slate-700">

                                {{-- Table Mode --}}
                                <div
                                    class="flex items-center w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rtl:text-right {{ $loop->first ? 'rounded-t-xl' : '' }} {{ $loop->last ? 'rounded-b-xl' : '' }} focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">

                                    {{-- Course Title  --}}
                                    <div class="text-xl"> Course
                                        {{ $loop->iteration }}: {{ $course->course_name }}
                                    </div>


                                    {{-- View Accordion Button --}}
                                    <button type="button" @click="isExpanded = ! isExpanded"
                                        :aria-expanded="isExpanded ? 'true' : 'false'"
                                        class="text-white  bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-700 dark:border-gray-800"
                                        :class="moduleID == xxxx ? 'ml-auto' : ''">
                                        Toggle Contents
                                        {{-- Chevron Icon --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke-width="2" stroke="currentColor"
                                            class="inline-block ml-2 transition size-5 shrink-0" aria-hidden="true"
                                            :class="isExpanded ? 'rotate-180' : ''">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>

                                </div>

                                {{-- Contents of Accordion --}}
                                <div x-cloak x-show="isExpanded" id="accordionItem-{{ $loop->iteration }}"
                                    role="region" aria-labelledby="controlsAccordionItem-{{ $loop->iteration }}"
                                    :class="isExpanded ? 'bg-gray-900' : ''" x-collapse>

                                    {{-- Start Module Content --}}
                                    <div class="w-full h-full p-5 border border-red-500">
                                        {{-- Table Accordion for Modules --}}
                                        <div>
                                            <div
                                                class="w-full overflow-hidden border divide-y divide-slate-300 rounded-xl border-slate-300 bg-slate-100/40 text-slate-700 dark:divide-slate-700 dark:border-slate-700 dark:bg-slate-800/50 dark:text-slate-300">

                                                @forelse ($course->modules as $module)
                                                    <div wire:key="module-{{ $module->id }}" x-data="{ isModuleExpanded: false }"
                                                        class="divide-y divide-slate-300 dark:divide-slate-700">

                                                        {{-- Table Mode of Module --}}
                                                        <div
                                                            class="flex items-center w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rtl:text-right {{ $loop->first ? 'rounded-t-xl' : '' }} {{ $loop->last ? 'rounded-b-xl' : '' }} focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">

                                                            {{-- Course Title  --}}
                                                            <div class="text-xl"> Module
                                                                {{ $loop->iteration }}: {{ $module->module_name }}
                                                            </div>


                                                            {{-- View Accordion Button --}}
                                                            <button type="button"
                                                                @click="isModuleExpanded = ! isModuleExpanded"
                                                                :aria-expanded="isModuleExpanded ? 'true' : 'false'"
                                                                class="text-white  bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-700 dark:border-gray-800"
                                                                :class="moduleID == xxxx ? 'ml-auto' : ''">
                                                                Toggle Contents
                                                                {{-- Chevron Icon --}}
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 24 24" fill="none" stroke-width="2"
                                                                    stroke="currentColor"
                                                                    class="inline-block ml-2 transition size-5 shrink-0"
                                                                    aria-hidden="true"
                                                                    :class="isModuleExpanded ? 'rotate-180' : ''">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                                </svg>
                                                            </button>

                                                        </div>

                                                        {{-- Contents of Accordion --}}
                                                        <div x-cloak x-show="isModuleExpanded"
                                                            id="accordionItem-{{ $loop->iteration }}" role="region"
                                                            aria-labelledby="controlsAccordionItem-{{ $loop->iteration }}"
                                                            :class="isExpanded ? 'bg-gray-900' : ''" x-collapse>

                                                            {{-- Start Lesson Content --}}
                                                            <div class="w-full h-full p-5 border border-red-500">
                                                                {{-- Table Accordion for Lessons --}}
                                                                <div>
                                                                    ......
                                                                </div>


                                                            </div>
                                                            {{-- End Lesson Content --}}

                                                        </div>

                                                    </div>
                                                @empty
                                                    <div
                                                        class="p-6 italic text-center text-gray-900 dark:text-gray-100">
                                                        <p>No Modules Added.</p>
                                                    </div>
                                                @endforelse

                                            </div>
                                        </div>


                                    </div>
                                    {{-- End Course Content --}}

                                </div>

                            </div>
                        @empty
                            <div class="p-6 italic text-center text-gray-900 dark:text-gray-100">
                                <p>No Courses Added.</p>
                            </div>
                        @endforelse

                    </div>

                    {{-- END Resource --}}

                </div>

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
