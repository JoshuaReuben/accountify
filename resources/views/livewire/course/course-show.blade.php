<div>

    <x-slot name="header">
        <h2 class="text-xl font-light leading-tight text-gray-800 dark:text-gray-200 ">
            Course &nbsp;
            <i class="text-sm fa-solid fa-chevron-right"></i> &nbsp;
            {{ $course->course_name }}
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
    {{-- Flowbite Accordion --}}
    {{-- .............. accordion flowbite backup .txt --}}
    {{-- End of Flowbite Accordion --}}


    {{-- Alpine Accordion --}}
    <div class="py-1">
        <div class="mx-auto max-w-9xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div x-data="{ mode: 'view', moduleID: '', moduleName: '' }" class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}

                    {{-- Buttons --}}
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
                                <input type="text" wire:model="module_name" name="create_module" id="create_module"
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
                            <div x-data="{ isExpanded: false }" class="divide-y divide-slate-300 dark:divide-slate-700">
                                {{-- Accordian Header -- Accordion Mode --}}
                                <button x-show="(mode === 'view') || (mode === 'create')"
                                    id="controlsAccordionItem-{{ $loop->iteration }}" type="button"
                                    class="flex items-center w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rtl:text-right {{ $loop->first ? 'rounded-t-xl' : '' }} focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300"
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
                                        class="transition size-5 shrink-0 ml-auto" aria-hidden="true"
                                        :class="isExpanded ? 'rotate-180' : ''">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>


                                {{-- Table Mode -- not yet checked - just repasted --}}
                                <div x-show="(mode === 'edit') || (mode === 'delete')"
                                    class="flex items-center w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rtl:text-right rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    {{-- Module Icon --}}
                                    <div
                                        class="p-2 text-center bg-white dark:bg-gray-800 place-content-center h-[75px] w-[75px] shadow-lg dark:border-gray-700 my-2 border rounded-full">
                                        <i class="text-3xl fa-solid fa-book-open-reader"></i>
                                    </div>

                                    {{-- Module Title  --}}
                                    <div x-show="(mode == 'edit') && (moduleID != {{ $module->id }})"
                                        class="text-xl"> Module
                                        {{ $loop->iteration }}:
                                        {{ $module->module_name }}
                                    </div>

                                    {{-- Module Title Edit Mode --}}
                                    <div x-show="(moduleID === {{ $module->id }})"
                                        class="flex flex-row items-center">
                                        <span class="text-xl w-[200px] text-center mr-2">Module
                                            {{ $loop->iteration }}:</span>

                                        <input type="text" wire:model="moduleNameToEdit.{{ $module->id }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        <x-buttons.primary-button
                                            wire:click="saveCurrentModuleName({{ $module->id }})" class="ms-2">
                                            Save
                                        </x-buttons.primary-button>
                                        <x-buttons.secondary-button wire:click="cancelEditModule"
                                            class="ms-2">Cancel
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
                                        class="focus:outline-none ml-auto text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Delete
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
                                            class="inline-block transition size-5 shrink-0 ml-2" aria-hidden="true"
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
                        @empty
                            <div class="p-6 italic text-center text-gray-900 dark:text-gray-100">
                                <p>No Modules Added.</p>
                            </div>
                        @endforelse


                    </div>

                    {{-- END SECTION --}}
                </div>
            </div>
        </div>
    </div>
    {{-- End of Alpine Accordion --}}








    {{-- .............................................................. --}}
    {{-- @script
        <script>
            function callFlowbite() {
                initFlowbite();
            }
            $wire.on('sendEvent', () => {
                initFlowbite();
                // alert('Success!');


                //After 1 second, call Flowbite again
                setTimeout(callFlowbite, 2000);
            });
        </script>
    @endscript --}}



</div>
