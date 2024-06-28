<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-light leading-tight text-gray-800 dark:text-gray-200 ">
            Course <i class="text-sm fa-solid fa-chevron-right"></i> {{ $course->course_name }}
        </h2>
    </x-slot>
    <hr class="dark:border-gray-900">

    {{-- Image and Course Details --}}
    <div class="md:flex md:flex-wrap md:flex-row-reverse md:h-[400px]">
        {{-- Cover Photo --}}
        <div class="h-[200px] md:h-full md:w-1/2 mx-auto "
            style="background-image: url('/storage/{{ $course->course_cover_photo }}'); background-size: cover; background-position: center">
        </div>

        {{-- Course Details --}}
        <div class="bg-white shadow md:h-full md:w-1/2 dark:bg-gray-800 ">
            <div class="px-4 py-6 mx-auto max-w-9xl sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold leading-tight text-gray-900 dark:text-gray-100">{{ $course->course_name }}
                    Netowrk Ffundamentals
                </h1>
            </div>

            {{-- Short Description --}}
            <div class="p-4 mx-auto max-w-9xl sm:px-6 lg:px-8">
                <p class="text-gray-700 dark:text-gray-400 line-clamp-6">{{ $course->course_description }} </p>
            </div>

            {{--  CTA - Get Started --}}
            <div class="p-4 mx-auto max-w-9xl sm:px-6 lg:px-8">
                <button type="button"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Get Started
                </button>
            </div>
        </div>
    </div>

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
                        <p class="font-bold text-gray-700 uppercase dark:text-gray-400 ">{{ $course->course_duration }}
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

    {{-- Curriculum - Modules  --}}
    <div class="py-1">
        <div class="mx-auto max-w-9xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div x-data="{ mode: 'view' }" class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}

                    <div class="flex items-center justify-between">
                        <h1 class="my-4 text-xl font-bold uppercase"> CREATED MODULES</h1>

                        <div>
                            {{-- Create --}}
                            <button @click="mode = 'create'" x-show="(mode === 'create') || (mode === 'view')"
                                type="button"
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                :class="{ 'opacity-50 cursor-not-allowed': mode === 'create' }">
                                Add Module &nbsp; <i class="fa-solid fa-plus"></i>
                            </button>

                            {{-- Edit --}}
                            <button @click="mode = 'edit'" x-show="(mode === 'edit') || (mode === 'view')"
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                :class="{ 'opacity-50 cursor-not-allowed': mode === 'edit' }">
                                Edit Module &nbsp; <i class="fa-solid fa-pencil"></i>
                            </button>

                            {{-- Delete --}}
                            <button @click="mode = 'delete'" x-show="(mode === 'delete') || (mode === 'view')"
                                type="button"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                :class="{ 'opacity-50 cursor-not-allowed': mode === 'delete' }">
                                Delete Module &nbsp; <i class="fa-solid fa-trash-can"></i>
                            </button>

                            {{-- Save Changes --}}
                            <button @click="mode = 'view'" x-show="mode != 'view'" type="button"
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                Save &nbsp; <i class="fa-solid fa-floppy-disk"></i>
                            </button>

                        </div>

                    </div>
                    <hr class="mb-4">

                    {{-- Create Form --}}
                    <div x-show="mode === 'create'" class="p-8 my-4 ">
                        <form wire:submit.prevent="createModule" class="max-w-md mx-auto">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="create_module" id="create_module"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="create_module"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Module Name
                                </label>
                            </div>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </form>
                    </div>
                    {{-- End Create Form --}}

                    <div id="accordion-collapse-modules" data-accordion="collapse">
                        {{-- 1 --}}
                        <h2 id="accordion-collapse-modules-heading-1">
                            {{-- Accordion Mode --}}
                            <button x-show="(mode === 'view') || (mode === 'create')" type="button"
                                class="flex items-center w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rtl:text-right rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                data-accordion-target="#accordion-collapse-modules-body-1" aria-expanded="false"
                                aria-controls="accordion-collapse-modules-body-1">
                                {{-- Module Icon --}}
                                <div
                                    class="p-2 text-center bg-white dark:bg-gray-800 place-content-center h-[75px] w-[75px] shadow-lg dark:border-gray-700 my-2 border rounded-full">
                                    <i class="text-3xl fa-solid fa-book-open-reader"></i>
                                </div>


                                {{-- Module Title --}}
                                <span class="text-xl">What is Accounting? </span>

                                {{-- Chevron Icon --}}
                                <svg data-accordion-icon class="w-3 h-3 ml-auto rotate-180 shrink-0"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
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



                                {{-- Module Title --}}
                                <span class="text-xl">What is Accounting? </span>

                                {{-- Edit Button --}}
                                <button x-show="(mode === 'edit')" type="button"
                                    class="text-white ml-auto bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Edit
                                </button>

                                <button x-show="(mode === 'delete')" type="button"
                                    class="focus:outline-none ml-auto text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    Delete
                                </button>



                                {{-- View Accordion Button --}}
                                <button type="button" data-accordion-target="#accordion-collapse-modules-body-1"
                                    aria-expanded="false" aria-controls="accordion-collapse-modules-body-1"
                                    class="text-white  bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-700 dark:border-gray-800">
                                    Toggle Contents
                                </button>

                            </div>
                        </h2>

                        <div id="accordion-collapse-modules-body-1" class="hidden"
                            aria-labelledby="accordion-collapse-modules-heading-1">
                            <div class="border border-b-0 border-gray-200 dark:border-gray-700 ">
                                {{-- Start Module Content --}}
                                <div
                                    class="w-full h-full text-gray-900 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-800 dark:text-white">

                                    <div
                                        class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:text-white">
                                        <i class="text-2xl fa-solid fa-circle-chevron-right me-3"></i>
                                        <span class="text-lg">Profile</span>
                                    </div>

                                    <div
                                        class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:text-white">
                                        <i class="text-2xl fa-solid fa-circle-chevron-right me-3"></i>
                                        <span class="text-lg">Profile</span>
                                    </div>
                                </div>

                                {{-- End Module Content --}}
                            </div>
                        </div>

                        {{-- 2 --}}
                        <h2 id="accordion-collapse-modules-heading-2">
                            <button type="button"
                                class="flex items-center justify-between w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rtl:text-right focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                                data-accordion-target="#accordion-collapse-modules-body-2" aria-expanded="false"
                                aria-controls="accordion-collapse-modules-body-2">
                                <span>Is there a Figma file available?</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-modules-body-2" class="hidden"
                            aria-labelledby="accordion-collapse-modules-heading-2">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is first conceptualized and
                                    designed using the Figma software so everything you see in the library has a design
                                    equivalent in our Figma file.</p>
                                <p class="text-gray-500 dark:text-gray-400">Check out the <a
                                        href="https://flowbite.com/figma/"
                                        class="text-blue-600 dark:text-blue-500 hover:underline">Figma design
                                        system</a>
                                    based on the utility classes from Tailwind CSS and components from Flowbite.</p>
                            </div>
                        </div>
                        {{-- 3 --}}
                        <h2 id="accordion-collapse-modules-heading-3">
                            <button type="button"
                                class="flex items-center justify-between w-full gap-3 p-5 font-medium text-gray-500 border border-gray-200 rtl:text-right focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                                data-accordion-target="#accordion-collapse-modules-body-3" aria-expanded="false"
                                aria-controls="accordion-collapse-modules-body-3">
                                <span>What are the differences between Flowbite and Tailwind UI?</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-modules-body-3" class="hidden"
                            aria-labelledby="accordion-collapse-modules-heading-3">
                            <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                                <p class="mb-2 text-gray-500 dark:text-gray-400">The main difference is that the core
                                    components from Flowbite are open source under the MIT license, whereas Tailwind UI
                                    is a paid product. Another difference is that Flowbite relies on smaller and
                                    standalone components, whereas Tailwind UI offers sections of pages.</p>
                                <p class="mb-2 text-gray-500 dark:text-gray-400">However, we actually recommend using
                                    both Flowbite, Flowbite Pro, and even Tailwind UI as there is no technical reason
                                    stopping you from using the best of two worlds.</p>
                                <p class="mb-2 text-gray-500 dark:text-gray-400">Learn more about these technologies:
                                </p>
                                <ul class="text-gray-500 list-disc ps-5 dark:text-gray-400">
                                    <li><a href="https://flowbite.com/pro/"
                                            class="text-blue-600 dark:text-blue-500 hover:underline">Flowbite Pro</a>
                                    </li>
                                    <li><a href="https://tailwindui.com/" rel="nofollow"
                                            class="text-blue-600 dark:text-blue-500 hover:underline">Tailwind UI</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    {{-- END SECTION --}}
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
