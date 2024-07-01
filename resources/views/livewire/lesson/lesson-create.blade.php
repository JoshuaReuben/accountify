<div>

    {{-- START SECTION --}}

    {{-- Sweet Alert --}}
    @if (session()->has('message'))
        <x-sweet-alert :message="session('message')" />
    @endif



    <h1 class="text-xl font-bold uppercase">Create a New lesson for: Module {{ $module_position }} -
        {{ $passed_module->module_name }}</h1>
    <form wire:submit.prevent="storeNewLesson2" class="mt-6 space-y-6">
        {{-- lesson title --}}
        <div>
            <x-input-label for="lesson_title" :value="__('lesson Name')" class="uppercase" />
            <x-text-input id="lesson_title" name="lesson_title" type="text" class="block w-full mt-1" required autofocus
                minLength="3" maxLength="150" />
            <x-input-error class="mt-2" :messages="$errors->get('lesson_title')" />
        </div>

        {{-- Experiment Phase - CK Editor --}}
        <div class="ckeditor--main-container border">
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

        <x-buttons.primary-button>{{ __('Save') }}</x-buttons.primary-button>
        <button type="button" id="logButton">Log Editor Content</button>
        <button type="button" id="testButton">Test Function</button>

    </form>

    {{-- END SECTION --}}


</div>
