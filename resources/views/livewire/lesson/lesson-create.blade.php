<div>
    <x-slot name="header">


        <div class="flex justify-between w-full">
            <div class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('LESSONS') }}
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
    {{-- START SECTION --}}

    {{-- Sweet Alert --}}
    @if (session()->has('message'))
        <x-sweet-alert :message="session('message')" />
    @endif


    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-xl font-bold uppercase">Module {{ $module_position }}:
                        {{ $passed_module->module_name }} - (Create
                        New
                        Lesson)</h1>
                    <form class="mt-6 space-y-6">
                        {{-- lesson title --}}
                        <div>
                            <x-input-label for="lesson_title" :value="__('lesson Name')" class="uppercase" />
                            <x-text-input id="lesson_title" name="lesson_title" type="text" class="block w-full mt-1"
                                required autofocus minLength="3" maxLength="150" />
                            <p id="lesson-title-error-msg" class="my-3 text-sm text-red-600 dark:text-red-400"></p>
                        </div>

                        {{-- Experiment Phase - CK Editor --}}
                        <div id="ckeditor--main-container" class="border ckeditor--main-container">
                            <div class="editor-container editor-container_document-editor " id="editor-container">
                                <div class="editor-container__menu-bar " id="editor-menu-bar"></div>
                                <div class="editor-container__toolbar " id="editor-toolbar"></div>
                                <div class="editor-container__editor-wrapper ">
                                    <div class="editor-container__editor ">
                                        <div class="" id="editor"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End of Experiment Phase --}}

                        <x-buttons.primary-button type="button"
                            id="storeNewLesson">{{ __('Save') }}</x-buttons.primary-button>


                    </form>
                </div>
            </div>
        </div>
    </div>




    {{-- END SECTION --}}


</div>
