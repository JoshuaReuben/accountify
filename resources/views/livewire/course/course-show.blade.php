<div>

    <x-alerts.sweet-alert-2 on="module-deleted" message="Module Deleted Successfully" />
    <x-alerts.sweet-alert-2 on="course-published" message="Course has been Published Successfully" />
    <x-alerts.sweet-alert-2 on="course-unpublished" message="Course has been Unpublished." />




    {{-- Sweet Alert --}}
    @if (session()->has('message'))
        <x-alerts.sweet-alert :message="session('message')" />

        @php
            session()->forget('message');
        @endphp
    @endif


    <x-slot name="header">
        <div class="flex justify-between">
            <div class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Course &nbsp;
                <i class="text-sm fa-solid fa-chevron-right"></i> &nbsp;
                {{ $course->course_name }}
            </div>

        </div>
    </x-slot>

    <hr class="dark:border-gray-900">


    {{-- Image and Course Details --}}
    <div class="md:flex md:flex-wrap md:flex-row-reverse justify-between md:h-[400px] w-full py-2  sm:px-6 lg:px-8  ">
        {{-- Cover Photo --}}
        <div class="h-[200px] md:h-full md:w-[50%] rounded-lg "
            style="background-image: url('/storage/{{ $course->course_cover_photo }}'); background-size: cover; background-position: center">
        </div>

        {{-- Course Details --}}
        <div class="bg-white rounded-lg shadow md:h-full md:w-[50%] dark:bg-gray-800">
            <div class="px-4 py-6 mx-auto max-w-9xl sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold leading-tight text-gray-900 dark:text-gray-100">
                    {{ $course->course_name }}
                </h1>
            </div>

            {{-- Short Description --}}
            <div class="p-4 mx-auto max-w-9xl sm:px-6 lg:px-8">
                <p class="text-gray-700 dark:text-gray-400 line-clamp-6">{{ $course->course_description }} </p>
            </div>

            {{--  CTA - Get Started --}}
            <div class="p-4 mx-auto max-w-9xl sm:px-6 lg:px-8">



                {{-- Actions --}}

                <div class="items-center">
                    {{-- Publish Course Button --}}
                    @if ($course->course_publish_date == null)
                        <x-buttons.create-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'publish-course')" message="Publish Course"
                            icon="fa-solid fa-calendar-check" />
                    @endif


                    {{-- Edit Button --}}
                    <a href="{{ route('pages.admin.course.edit', $course->id) }}">
                        <x-buttons.edit-button message="Edit Course" />
                    </a>

                    {{-- Delete Button --}}
                    <div class="inline-block" wire:confirm="Are you sure you want to delete this course?"
                        wire:click="deleteACourse({{ $course->id }})">
                        <x-buttons.delete-button message="Delete Course" />
                    </div>

                    {{-- Unpublish Button --}}
                    @if ($course->course_publish_date)
                        <x-buttons.my-secondary-button type="button" x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'unpublish-course')" message="Unpublish Course"
                            icon="fa-solid fa-calendar-xmark" />
                    @endif
                </div>


            </div>
        </div>
    </div>

    {{-- MODAL for Publish A Course --}}
    <x-modal name="publish-course" focus="true" bgColor="">
        <div class="w-full h-[90vh]  flex items-center justify-center">
            <div id="edit-timer" class="items-center justify-center w-full overflow-x-hidden overflow-y-auto">
                <div class="relative w-full max-w-2xl max-h-full p-4">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Publish Course Now?
                            </h3>
                            <button x-on:click="$dispatch('close')" type="button"
                                class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="p-4 space-y-4 md:p-5">
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                <span class="font-bold text-white">Note: </span>
                                Publishing the course will make it available for students to see and take the
                                course.
                                Unpublished courses remain hidden from students. Before publishing, please make sure to
                                confirm all the details below.
                            </p>
                            {{-- HR - START --}}
                            <hr
                                class="w-full h-[2px] mx-auto my-4 bg-gray-900 border-0 rounded md:my-10 dark:bg-gray-100">
                            {{-- HR - END --}}
                            {{-- Content --}}
                            <div class="overflow-y-auto h-[400px]">

                                <!-- Warning Alert -->
                                @if ($course->isCourseReadyToPublish() == false)
                                    <div class="w-[90%] mx-auto mt-1 mb-4">
                                        <div class="relative w-full overflow-hidden bg-white border rounded-xl border-amber-500 text-slate-700 dark:bg-slate-900 dark:text-slate-300"
                                            role="alert">
                                            <div class="flex items-center w-full gap-2 p-4 bg-amber-500/10">
                                                <div class="p-1 rounded-full bg-amber-500/15 text-amber-500"
                                                    aria-hidden="true">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="size-6" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="ml-2">
                                                    <h3 class="text-sm font-semibold text-amber-500"> Can't Be Published
                                                    </h3>
                                                    <p class="text-xs font-medium sm:text-sm">Your course details
                                                        contain
                                                        incomplete details. Please complete them before publishing.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                {{-- Course Title --}}
                                <h1 class="text-xl text-gray-500 dark:text-gray-400"><span class="text-white"> Course
                                        Title:</span>
                                    {{ $course->course_name }}
                                </h1>
                                {{-- Course Exam Count --}}
                                <p class="mb-4 text-lg text-gray-500 dark:text-gray-400">
                                    <i
                                        class="fa-solid {{ $course->courseQuestions()->count() > 0 ? 'text-green-500 fa-check' : 'text-red-500 fa-xmark' }}  "></i>&nbsp;
                                    <span class="text-white">
                                        Course Exam:</span>
                                    {{ $course->courseQuestions()->count() }} Questions
                                </p>

                                <ul class="space-y-4 text-gray-500 list-inside dark:text-gray-400">
                                    {{-- Modules Loop --}}
                                    @forelse ($course->modules as $module)
                                        <li class="ml-6">
                                            <h1 class="mt-4"> <span class="text-white">Module
                                                    {{ $loop->iteration }}:</span>
                                                {{ $module->module_name }}</h1>
                                            <p><i
                                                    class="fa-solid {{ $module->moduleQuestions()->count() > 0 ? 'text-green-500 fa-check' : 'text-red-500 fa-xmark' }}  "></i>&nbsp;
                                                <span class="text-white">Module Exam:</span>
                                                {{ $module->moduleQuestions()->count() }} Questions
                                            </p>
                                            <ul class="space-y-1 list-disc list-inside ps-5">
                                                {{-- Lessons Loop --}}
                                                @forelse ($module->lessons as $lesson)
                                                    <li class="pt-1"> <span class="text-white">Lesson
                                                            {{ $loop->iteration }}:</span>
                                                        {{ $lesson->lesson_title }} </li>

                                                    <p class="indent-4"> <i
                                                            class="fa-solid {{ $lesson->questions->count() > 0 ? 'text-green-500 fa-check' : 'text-red-500 fa-xmark' }}  "></i>&nbsp;
                                                        {{ $lesson->questions->count() }}
                                                        Questions </p>

                                                    <p class="indent-4"> <i
                                                            class="fa-solid {{ $lesson->flashcards->count() > 0 ? 'text-green-500 fa-check' : 'text-red-500 fa-xmark' }}  "></i>&nbsp;
                                                        {{ $lesson->flashcards->count() }}
                                                        Flashcards</p>
                                                @empty
                                                    <p class="italic"><i
                                                            class="text-red-500 fa-solid fa-xmark "></i>&nbsp;
                                                        No Lessons Added.</p>
                                                @endforelse
                                            </ul>
                                        </li>
                                    @empty
                                        <p class="italic"><i class="text-red-500 fa-solid fa-xmark "></i>&nbsp; No
                                            Modules Added.</p>
                                    @endforelse

                                    {{--  --}}
                                </ul>





                            </div>

                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600">
                            <button type="button" wire:click="publishCourse({{ $course->id }})"
                                x-on:click="$dispatch('close')"
                                {{ $course->isCourseReadyToPublish() ? '' : 'disabled' }}
                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 disabled:opacity-50 disabled:cursor-not-allowed ">
                                Publish Now
                            </button>
                            <button x-on:click="$dispatch('close')" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-modal>

    {{-- MODAL for Unpublishing A Course --}}
    <x-modal name="unpublish-course" focus="true" bgColor="">
        <div class="w-full h-[90vh]  flex items-center justify-center">
            <div id="edit-timer" class="items-center justify-center w-full overflow-x-hidden overflow-y-auto">
                <div class="relative w-full max-w-2xl max-h-full p-4">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Do you want to unpublish this course?
                            </h3>
                            <button x-on:click="$dispatch('close')" type="button"
                                class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="p-4 space-y-4 md:p-5">
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                <span class="font-bold text-white">Note: </span>
                                Unpublishing this course will make it unlisted from the platform. This action makes
                                the course hidden from user's end. Do you still want to proceed?
                            </p>



                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600">
                            <button type="button" wire:click="unpublishCourse({{ $course->id }})"
                                x-on:click="$dispatch('close')"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 disabled:opacity-50 disabled:cursor-not-allowed ">
                                Unpublish Now
                            </button>
                            <button x-on:click="$dispatch('close')" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100  focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-modal>

    {{-- Icons - Self Paced - Hours, Difficulty --}}
    <div class="py-1">
        <div class="mx-auto max-w-9xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-wrap p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}

                    <div class="p-2 text-center bg-white dark:bg-gray-800  min-w-[150px] my-2">
                        <i class="text-2xl fa-solid fa-chalkboard-user"></i>
                        <p class="font-bold text-gray-700 uppercase dark:text-gray-400 ">Self-Paced</p>
                    </div>

                    <div class="p-2 text-center bg-white dark:bg-gray-800  min-w-[150px] my-2">
                        <i class="text-2xl fa-regular fa-clock"></i>
                        <p class="font-bold text-gray-700 uppercase dark:text-gray-400 ">
                            {{ $course->course_duration }}
                            Hours</p>
                    </div>

                    <div class="p-2 text-center bg-white dark:bg-gray-800  min-w-[150px] my-2">
                        <i class="text-2xl fa-solid fa-bars-progress"></i>
                        <p class="font-bold text-gray-700 uppercase dark:text-gray-400 ">
                            {{ $course->course_difficulty }}</p>
                    </div>

                    <div class="p-2 text-center bg-white dark:bg-gray-800  min-w-[150px] my-2">
                        <i class="text-2xl fa-solid fa-calendar-check"></i>
                        <p class="font-bold text-gray-700 uppercase dark:text-gray-400 ">
                            {{ $course->course_publish_date ? $course->course_publish_date : 'Not Published' }} </p>
                    </div>

                    {{-- END SECTION --}}
                </div>
            </div>
        </div>
    </div>

    {{-- BADGES --}}
    <div class="">
        <div class="mx-auto max-w-9xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}

                    <h1 class="uppercase">Achievements</h1>
                    <p class="text-gray-700 dark:text-gray-400">Badges you can earn in this course.</p>

                    <div
                        class="p-2 text-center bg-white dark:bg-gray-800  w-[150px] shadow-lg dark:border-gray-700 my-2 border rounded-lg">
                        <i class="text-3xl fa-solid fa-medal"></i>
                        <p class="font-bold text-gray-700 uppercase dark:text-gray-400 ">
                            Network Specialist</p>
                    </div>
                    {{-- END SECTION --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Course Overview - Long Description --}}
    <div class="py-1">
        <div class="mx-auto max-w-9xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}

                    <h1 class="text-xl uppercase">OVERVIEW</h1>


                    <div class="p-2 bg-white dark:bg-gray-800 ">
                        <p class="font-bold text-gray-700 dark:text-gray-400 ">{{ $course->course_overview }}

                        </p>
                    </div>
                    {{-- END SECTION --}}
                </div>
            </div>
        </div>
    </div>



    {{-- MODULES Accordion --}}
    <div class="py-1">
        <div class="mx-auto max-w-9xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div x-data="{ mode: 'view', moduleID: '' }" class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}

                    {{-- Buttons --}}
                    <div class="flex items-center justify-between">
                        <h1 class="my-4 text-xl font-bold uppercase"> CREATED MODULES</h1>
                        <div>

                            {{-- Create Module --}}
                            <x-buttons.create-button message="Add Module" @click="mode = 'create'"
                                x-show="(mode === 'create') || (mode === 'view')"
                                x-bind:disabled="mode === 'create'" />

                            {{-- Edit Module --}}
                            <x-buttons.edit-button message="Edit Module" @click="mode = 'edit'"
                                x-show="(mode === 'edit') || (mode === 'view')"
                                x-bind:disabled="mode === 'edit'" />

                            {{-- Delete Module --}}
                            <x-buttons.delete-button Message="Delete Module" @click="mode = 'delete'"
                                x-show="(mode === 'delete') || (mode === 'view')"
                                x-bind:disabled="mode === 'delete'" />

                            {{-- Back to Options --}}
                            <button @click="mode = 'view'; moduleID = ''" x-show="mode != 'view'" type="button"
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 disabled:hidden"
                                :disabled="moduleID !== ''">
                                Back to Options &nbsp; <i class="fa-solid fa-filter"></i>
                            </button>
                        </div>

                    </div>
                    <hr class="mb-4">

                    {{-- Create Form --}}
                    <div x-show="mode === 'create'" class="p-8 my-4 ">
                        <form wire:submit.prevent="createModule" class="max-w-md mx-auto">
                            <h1 class="my-4 text-xl font-bold uppercase">Create New Module</h1>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" wire:model="module_name" name="create_module"
                                    id="create_module"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="create_module"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Module Name
                                </label>
                            </div>
                            <button wire:loading.remove wire:target="createModule" type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Submit
                            </button>

                            <button wire:loading wire:target="createModule" type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg aria-hidden="true" role="status"
                                    class="inline w-4 h-4 text-white me-3 animate-spin" viewBox="0 0 100 101"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="#E5E7EB" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentColor" />
                                </svg>
                                Loading...
                            </button>

                            <x-action-message class="inline-block mx-3" on="module-created">
                                {{ __('Saved.') }}
                            </x-action-message>
                        </form>
                    </div>
                    {{-- End Create Form --}}





                    <div
                        class="w-full overflow-hidden border divide-y divide-slate-300 rounded-xl border-slate-300 bg-slate-100/40 text-slate-700 dark:divide-slate-700 dark:border-slate-700 dark:bg-slate-800/50 dark:text-slate-300">

                        @forelse ($course->modules as $module)
                            <div wire:key="module-{{ $module->id }}" x-data="{ isExpanded: false }"
                                class="divide-y divide-slate-300 dark:divide-slate-700">
                                {{-- Accordian Header -- Accordion Mode --}}
                                <button x-show="(mode === 'view') || (mode === 'create')"
                                    id="controlsAccordionItem-{{ $loop->iteration }}" type="button"
                                    class="flex items-center w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rtl:text-right {{ $loop->first ? 'rounded-t-xl' : '' }} focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50 dark:hover:text-gray-300"
                                    aria-controls="accordionItem-{{ $loop->iteration }}"
                                    @click="isExpanded = ! isExpanded" :aria-expanded="isExpanded ? 'true' : 'false'">

                                    {{-- Module Icon --}}
                                    <div
                                        class="p-2 text-center bg-white dark:bg-gray-800 place-content-center h-[75px] w-[75px] shadow-lg dark:border-gray-700 my-2 border rounded-full">
                                        <i class="text-3xl fa-solid fa-book-open-reader"></i>
                                    </div>

                                    {{-- Module Title --}}
                                    <span class="text-xl" :class="isExpanded ? 'font-bold text-white' : ''"> Module
                                        {{ $loop->iteration }}: {{ $module->module_name }}
                                    </span>


                                    {{-- Chevron Icon --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke-width="2" stroke="currentColor"
                                        class="ml-auto transition size-5 shrink-0" aria-hidden="true"
                                        :class="isExpanded ? 'rotate-180' : ''">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>


                                {{-- Table Mode --}}
                                <div x-show="(mode === 'edit') || (mode === 'delete')"
                                    class="flex items-center w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rtl:text-right rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    {{-- Module Icon --}}
                                    <div
                                        class="p-2 text-center bg-white dark:bg-gray-800 place-content-center h-[75px] w-[75px] shadow-lg dark:border-gray-700 my-2 border rounded-full">
                                        <i class="text-3xl fa-solid fa-book-open-reader"></i>
                                    </div>

                                    {{-- Module Title  --}}
                                    <div x-show="  ((mode == 'edit') && (moduleID != {{ $module->id }})) || (mode == 'delete')"
                                        class="text-xl"> Module
                                        {{ $loop->iteration }}:
                                        {{ $module->module_name }}
                                    </div>

                                    {{-- Module Title Edit Mode --}}
                                    <div x-show="(moduleID === {{ $module->id }})"
                                        class="flex flex-row items-center">
                                        <span class="text-xl w-[200px] text-center mr-2">Module
                                            {{ $loop->iteration }}:</span>

                                        <input type="text" wire:model="EDIT_module_name.{{ $module->id }}"
                                            wire:keydown.enter="saveModuleName({{ $module->id }})"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        {{-- Save Edit --}}
                                        <x-buttons.primary-button wire:click="saveModuleName({{ $module->id }})"
                                            wire:loading.attr="disabled"
                                            wire:target="saveModuleName({{ $module->id }})"
                                            x-on:module-name-updated.window="moduleID = ''" class="ms-2">
                                            <span wire:loading.remove
                                                wire:target="saveModuleName({{ $module->id }})">Save</span>
                                            <span wire:loading
                                                wire:target="saveModuleName({{ $module->id }})"><x-svgs.spinner
                                                    size="5" message="Saving" /></span>
                                        </x-buttons.primary-button>

                                        {{-- Cancel Edit --}}
                                        <x-buttons.secondary-button @click="moduleID = ''"
                                            wire:click="cancelEditModule()" class="ms-2">Cancel
                                        </x-buttons.secondary-button>
                                    </div>




                                    {{-- Edit Button --}}
                                    <button @click="moduleID = {{ $module->id }}"
                                        x-show="(mode === 'edit') && (moduleID != {{ $module->id }})"
                                        type="button"
                                        class="text-white ml-auto bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        Edit
                                    </button>


                                    {{--  Delete Button --}}
                                    <button x-show="(mode === 'delete')" type="button"
                                        wire:confirm="Are you sure you want to delete this Module?"
                                        wire:click="deleteModule({{ $module->id }})" wire:loading.attr="disabled"
                                        wire:target="deleteModule({{ $module->id }})"
                                        class="focus:outline-none ml-auto text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 disabled:cursor-not-allowed disabled:opacity-50">
                                        <span wire:loading.remove
                                            wire:target="deleteModule({{ $module->id }})">Delete</span>
                                        <span wire:loading
                                            wire:target="deleteModule({{ $module->id }})"><x-svgs.spinner
                                                message="Deleting..." size="5" /></span>
                                    </button>

                                    {{-- View Accordion Button --}}
                                    <button type="button" @click="isExpanded = ! isExpanded"
                                        :aria-expanded="isExpanded ? 'true' : 'false'"
                                        class="text-white  bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-700 dark:border-gray-800"
                                        :class="moduleID == {{ $module->id }} ? 'ml-auto' : ''">
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
                                    <div
                                        class="w-full h-full text-gray-900 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 dark:text-white">

                                        <a href="{{ route('pages.admin.lesson', ['courseID' => $module->course_id, 'moduleID' => $module->id]) }}"
                                            class="relative inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-center border-b border-gray-800 cursor-pointer group focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:bg-gray-800/20 dark:focus:ring-gray-500 dark:focus:text-white dark:hover:bg-gray-800/70 hover:bg-gray-100">
                                            <i class="text-2xl italic fa-solid fa-plus me-3"></i>
                                            <span class="text-lg italic group-hover:underline">Add New
                                                Lessons</span>
                                        </a>

                                        @if ($module->lessons->count() > 0)
                                            <a href="{{ route('pages.admin.question.module', ['courseID' => $module->course_id, 'moduleID' => $module->id]) }}"
                                                class="relative inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-center border-b border-gray-800 cursor-pointer group focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:bg-gray-800/20 dark:focus:ring-gray-500 dark:focus:text-white dark:hover:bg-gray-800/70 hover:bg-gray-100">
                                                {{-- Check If Module Examinations Have Questions --}}
                                                @if ($module->moduleQuestions()->count() <= 0)
                                                    <i class="text-2xl italic fa-solid fa-file-lines me-3"></i>
                                                    <span class="text-lg italic group-hover:underline">
                                                        Create Module Examination
                                                    </span>
                                                @else
                                                    <i class="text-lg fa-solid fa-eye me-3 "></i>
                                                    <span class="text-lg italic group-hover:underline">
                                                        View Module Examination
                                                        {{ $module->moduleQuestions()->count() == 1 ? '(' . $module->moduleQuestions()->count() . ' Question)' : '(' . $module->moduleQuestions()->count() . ' Questions)' }}
                                                    </span>
                                                @endif

                                            </a>
                                        @else
                                            <button type="button" disabled
                                                class="relative inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-center border-b border-gray-800 cursor-pointer focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:bg-gray-800/20 disabled:opa dark:focus:ring-gray-500 dark:focus:text-white dark:hover:bg-gray-700 hover:bg-gray-100 disabled:cursor-not-allowed disabled:opacity-50">
                                                <span class="text-lg italic ">
                                                    Have Atleast 1 Lesson to Create Module Examination
                                                </span>
                                            </button>
                                        @endif




                                        @foreach ($module->lessons as $lesson)
                                            <a href="{{ route('pages.admin.lesson.show', ['courseID' => $module->course_id, 'moduleID' => $module->id, 'lessonID' => $lesson->id]) }}"
                                                class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 cursor-pointer group focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:focus:ring-gray-500 dark:bg-gray-700/90 dark:focus:text-white dark:hover:bg-gray-800 hover:bg-gray-100">
                                                <i class="text-2xl fa-solid fa-circle-chevron-right me-3"></i>
                                                <span class="text-lg group-hover:underline">Lesson
                                                    {{ $loop->iteration }}: {{ $lesson->lesson_title }}</span>
                                            </a>
                                        @endforeach

                                    </div>
                                    {{-- End Module Content --}}

                                </div>

                            </div>
                        @empty
                            <div class="p-6 italic text-center text-gray-900 dark:text-gray-100">
                                <p>No Modules Added.</p>
                            </div>
                        @endforelse

                    </div>





                    <div class="flex items-center justify-center w-full h-20 mt-5">
                        {{-- If course have more than 1 module --}}
                        @if ($this->lessonsCount > 0)
                            <a href="{{ route('pages.admin.question.course', ['courseID' => $this->course->id]) }}">
                                {{-- If Course Exams have Questions --}}
                                @if ($this->course->courseQuestions()->count() == 0)
                                    <x-buttons.create-button message="Create Course Exam"
                                        icon="fa-solid fa-file-lines" />
                                @else
                                    <x-buttons.create-button message="View Course Exam"
                                        icon="fa-solid fa-file-lines" />
                                @endif
                            </a>
                        @elseif ($this->lessonsCount <= 0 && $this->course->modules->count() > 0)
                            {{-- If course have atleast 1 module but no lessons --}}
                            <div class="p-6 italic text-center text-gray-900 dark:text-gray-100 opacity-70">
                                <p> Course Examination (Atleast 1 Lesson Required).</p>
                            </div>
                        @else
                            <div class="p-6 italic text-center text-gray-900 dark:text-gray-100 opacity-70">
                                <p> Course Examination (Atleast 1 Module Required).</p>
                            </div>
                        @endif
                    </div>

                    {{-- END SECTION --}}
                </div>
            </div>
        </div>
    </div>
    {{-- End of Alpine Accordion --}}




</div>
