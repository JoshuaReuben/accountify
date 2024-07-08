<div>


    {{-- Sweet Alert --}}
    @if (session()->has('message'))
        <x-sweet-alert :message="session('message')" />
    @endif


    <x-sweet-alert-2 on="module-question-deleted" message="Question Deleted Successfully" />
    <x-sweet-alert-2 on="module-question-added" message="Question Added Successfully" />
    <x-sweet-alert-2 on="module-question-updated" message="Question Updated Successfully" />




    <x-slot name="header">
        <div class="flex justify-between w-full">
            <div class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('MODULE  ') }}{{ $module_position . ' | ' . $passed_module->module_name }}
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
        {{-- <livewire:layout.resource-sidebar-for-lessons courseID="{{ $courseID }}" moduleID="{{ $moduleID }}" /> --}}
        <livewire:layout.resource-sidebar-for-lessons courseID="{{ $courseID }}" moduleID="{{ $moduleID }}" />
    </x-slot>


    {{-- FIRST SECTION --}}
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}


                    <h1 class="text-xl font-bold uppercase">Create Module Examination</h1>
                    <form wire:submit.prevent="storeQuestion" class="mt-6 space-y-6">

                        {{-- Question ASKED --}}
                        <div class="pb-6">
                            <x-input-label for="question_asked" :value="__('Question')" class="mb-1 uppercase" />
                            {{-- TEXT BOX --}}
                            <textarea wire:model.live="question_asked" id="question_asked" name="question_asked"
                                class="block w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                required autofocus minLength="5" maxlength="500" rows="3" placeholder="Put the Question here..."></textarea>

                            <x-input-error class="mt-2" :messages="$errors->get('question_asked')" />
                        </div>



                        {{-- CREATE CHOICES --}}
                        <div>
                            <div class="flex items-end justify-between">
                                <x-input-label for="CHOICES" :value="__('CHOICES')" class="uppercase" />

                                {{-- Add Input Field --}}
                                <button type="button" wire:click="addChoice"
                                    class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    <span wire:loading.remove wire:target="addChoice">Add Choices &nbsp; <i
                                            class=" fa-solid fa-plus"></i></span>
                                    <div wire:loading wire:target="addChoice">
                                        <x-svgs.spinner message="Adding" size="5" />
                                    </div>
                                </button>
                            </div>

                            @php
                                $letter = 'A';
                            @endphp
                            @foreach ($choices as $key => $choice)
                                <div wire:key="choice-{{ $key }}" class="flex items-center">
                                    {{-- Input Field for Choices --}}
                                    <p class="mx-2">{{ $letter }}. </p>
                                    <x-text-input wire:model.live="choices.{{ $key }}.choice" id="CHOICES"
                                        name="CHOICES" type="text" class="block w-full mt-1" required autofocus
                                        minLength="1" maxLength="255" />


                                    {{-- Show The Remove Button When Loop Count is Greater than 1 --}}
                                    @if ($loop->count > 2)
                                        {{-- Remove Input Field --}}
                                        <button type="button" wire:click="removeChoice({{ $key }})"
                                            class="px-4 py-1.5 mx-2 text-sm font-medium text-white bg-red-700 rounded-lg focus:outline-none hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                            wire:loading.class="opacity-50 cursor-not-allowed"
                                            wire:loading.attr="disabled">
                                            <i wire:loading.remove wire:target="removeChoice({{ $key }})"
                                                class="text-lg fa-solid fa-xmark"></i>
                                            <div wire:loading wire:target="removeChoice({{ $key }})">
                                                ...
                                            </div>
                                        </button>
                                    @endif

                                </div>
                                {{-- Show Error Message for Each Choice --}}
                                <x-input-error class="mt-2" :messages="$errors->get('choices.' . $key . '.choice')" />


                                @php
                                    $letter++;
                                @endphp
                            @endforeach



                        </div>





                        {{-- CORRECT ASNSWER --}}
                        <div>
                            <x-input-label for="correct_answer" :value="__('CORRECT ANSWER')" class="mb-2 uppercase" />
                            <select id="correct_answer" wire:model="correct_answer" name="correct_answer" required
                                @if (!$this->hasAtLeastTwoChoices()) disabled @endif
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:cursor-not-allowed">
                                <option value="Choose correct answer" selected
                                    @if ($this->hasAtLeastTwoChoices()) disabled @endif>Choose correct answer
                                    @if (!$this->hasAtLeastTwoChoices())
                                        <span class="italic"> (Create Choices First)</span>
                                    @endif
                                </option>


                                <!-- Show Choices when at least two choices have non-empty values -->
                                @if ($this->hasAtLeastTwoChoices())
                                    @foreach ($choices as $choice)
                                        @if (!empty($choice['choice']))
                                            <option value="{{ $choice['choice'] }}">{{ $choice['choice'] }}</option>
                                        @endif
                                    @endforeach
                                @endif


                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('correct_answer')" />

                            @error('choices')
                                <span class="space-y-1 text-sm text-red-600 dark:text-red-400">
                                    <strong>Error:</strong> {{ $message }}
                                </span>
                            @enderror
                        </div>




                        <div wire:target="storeQuestion" class="flex items-center gap-4">
                            <x-buttons.primary-button wire:loading.attr="disabled"
                                wire:loading.class="opacity-50 cursor-not-allowed">{{ __('Save') }}</x-buttons.primary-button>
                        </div>

                        <div wire:loading wire:target="storeQuestion">
                            <div class="flex items-center">
                                <div role="status">
                                    <svg aria-hidden="true"
                                        class="w-6 h-6 text-gray-200 me-2 animate-spin dark:text-gray-700 fill-gray-600"
                                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor" />
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill" />
                                    </svg>
                                </div>
                                Saving your questions...
                            </div>
                        </div>
                    </form>


                    {{-- ---------------------- --}}
                </div>
            </div>
        </div>
    </div>



    {{-- SECOND SECTION --}}
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div x-data="{ mode: 'view', questionID: '' }" x-on:module-question-updated.window="questionID = ''"
                    class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-xl font-bold uppercase">MODULE QUESTION LIST:</h1>
                        </div>
                        <div>


                            {{-- Edit --}}
                            <button type="button" @click="mode = 'edit'"
                                x-show="(mode === 'view') || (mode === 'edit')"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                :class="{ 'opacity-50 cursor-not-allowed': mode === 'edit' }">
                                Edit Question &nbsp; <i class="fa-solid fa-pencil"></i>
                            </button>

                            {{-- Delete --}}
                            <button type="button" @click="mode = 'delete'"
                                x-show="(mode === 'view') || (mode === 'delete')"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                :class="{ 'opacity-50 cursor-not-allowed': mode === 'delete' }">
                                Delete Question &nbsp; <i class="fa-solid fa-trash-can"></i>
                            </button>

                            {{-- Back To Menu --}}
                            <button type="button" @click="mode = 'view'; questionID = ''"
                                x-show="mode != 'view' && (questionID == '')"
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 disabled:hidden">
                                Normal View &nbsp; <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>

                    </div>


                    <hr class="mb-4">


                    {{-- List --}}
                    <ol
                        class="space-y-4 text-gray-500 break-words list-decimal list-inside text-ellipsis dark:text-gray-100 ">

                        @forelse ($fetched_questions as $question)
                            <div class="flex w-full break-words text-ellipsis ">
                                {{-- Edit Icon --}}
                                <span class="me-2 " x-show="mode == 'edit' && (questionID !== {{ $question->id }})">
                                    <button type="button" @click="questionID = {{ $question->id }}"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <i class="text-xs fa-solid fa-pencil"></i>
                                    </button>
                                </span>

                                {{-- Delete Icon --}}
                                <span class="me-2" x-show="mode == 'delete'">
                                    <button type="button"
                                        wire:confirm="Are you sure you want to delete this Question?"
                                        wire:click="deleteQuestion({{ $question->id }})"
                                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 focus:outline-none">
                                        <i class="text-xs fa-solid fa-minus"></i>
                                    </button>
                                </span>
                                <li class="w-full break-words  dark:text-gray-100 text-ellipsis max-w-[1120px]"
                                    :class="{
                                        'border-y-2 py-2 pt-4 my-6 border-gray-700 dark:border-gray-200 ': questionID ==
                                            '{{ $question->id }}'
                                    }">
                                    <div class="inline" :class="{ 'hidden': questionID == '{{ $question->id }}' }">
                                        {{-- Question --}}
                                        <span class="w-full break-words dark:text-gray-100">
                                            {{ $question->question }}</span>

                                        <ul
                                            class="mt-2 space-y-1 break-words list-disc list-inside ps-5 text-ellipsis">
                                            @foreach ($question->choices as $key => $choice)
                                                <li
                                                    class="{{ $choice['choice'] === $question->correct_answer ? 'text-green-500 dark:text-green-400' : '' }}">
                                                    {{ $choice['choice'] }}</li>
                                            @endforeach
                                        </ul>
                                        {{-- End Question --}}
                                    </div>

                                    {{-- Edit Mode View - Container --}}
                                    <div class="inline italic" x-show="questionID == '{{ $question->id }}'">
                                        Currently Editing Question #{{ $loop->iteration }}:
                                    </div>

                                    {{-- Edit Mode View - Form --}}
                                    <form x-show="questionID == '{{ $question->id }}'"
                                        wire:submit.prevent="updateAQuestion({{ $question->id }})"
                                        class="mt-6 space-y-6">

                                        {{-- Question ASKED FOR THE EDIT MODE --}}
                                        <div class="pb-6">
                                            <x-input-label for="question_asked_Edit_Mode_{{ $question->id }}"
                                                :value="__('Question')" class="mb-1 uppercase" />
                                            {{-- TEXT BOX --}}
                                            <textarea wire:model.live="EDIT_question_asked.{{ $question->id }}" id="EDIT_question_asked_{{ $question->id }}"
                                                name="EDIT_question_asked.{{ $question->id }}"
                                                class="block w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                                required autofocus minLength="5" maxlength="500" rows="3" placeholder="Put the Question here...">{{ $EDIT_question_asked[$question->id] }}</textarea>

                                            <x-input-error class="mt-2" :messages="$errors->get('EDIT_question_asked.' . $question->id)" />
                                        </div>



                                        {{-- CREATE CHOICES FOR THE EDIT MODE --}}
                                        <div>
                                            <div class="flex items-end justify-between">
                                                <x-input-label for="EDIT_CHOICES" :value="__('CHOICES')"
                                                    class="uppercase" />

                                                {{-- Add Input Field --}}
                                                <button tabindex="{{ $loop->iteration }}}" type="button"
                                                    wire:click="addChoice_Edit_Mode({{ $question->id }})"
                                                    class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    <span wire:loading.remove wire:target="addChoice_Edit_Mode">Add
                                                        Choices
                                                        &nbsp; <i class=" fa-solid fa-plus"></i></span>
                                                    <div wire:loading wire:target="addChoice_Edit_Mode">
                                                        <x-svgs.spinner message="Adding" size="5" />
                                                    </div>
                                                </button>
                                            </div>

                                            @php
                                                $letter_edit_mode = 'A';
                                            @endphp
                                            {{-- Edit Mode Loop --}}
                                            @foreach ($EDIT_choices[$question->id] as $key => $choice)
                                                <div wire:key="choice-editmode-{{ $key }}"
                                                    class="flex items-center">
                                                    {{-- Input Field for Choices --}}
                                                    <p class="mx-2">{{ $letter_edit_mode }}. </p>
                                                    <x-text-input
                                                        wire:model.live="EDIT_choices.{{ $question->id }}.{{ $key }}.choice"
                                                        id="EDIT_CHOICES" name="EDIT_CHOICES" type="text"
                                                        class="block w-full mt-1" required autofocus minLength="1"
                                                        maxLength="255" />


                                                    {{-- Show The Remove Button When Loop Count is Greater than 1 --}}
                                                    @if ($loop->count > 2)
                                                        {{-- Remove Input Field --}}
                                                        <button type="button"
                                                            wire:click="removeChoice_Edit_Mode({{ $question->id }} ,{{ $key }})"
                                                            class="px-4 py-1.5 mx-2 text-sm font-medium text-white bg-red-700 rounded-lg focus:outline-none hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                            wire:loading.class="opacity-50 cursor-not-allowed"
                                                            wire:loading.attr="disabled">
                                                            <i wire:loading.remove
                                                                wire:target="removeChoice_Edit_Mode({{ $key }})"
                                                                class="text-lg fa-solid fa-xmark"></i>
                                                            <div wire:loading
                                                                wire:target="removeChoice_Edit_Mode({{ $key }})">
                                                                ...
                                                            </div>
                                                        </button>
                                                    @endif

                                                </div>
                                                {{-- Show Error Message for Each Choice --}}
                                                <x-input-error class="mt-2" :messages="$errors->get(
                                                    'EDIT_choices.' . $question->id . '.' . $key . '.choice',
                                                )" />







                                                @php
                                                    // dd('EDIT_choices.' . $question->id . '.' . $key . '.choice');
                                                    $letter_edit_mode++;
                                                @endphp
                                            @endforeach



                                        </div>





                                        {{-- CORRECT ASNSWER --}}
                                        <div>
                                            <x-input-label for="EDIT_correct_answer" :value="__('CORRECT ANSWER')"
                                                class="mb-2 uppercase" />
                                            <select id="EDIT_correct_answer"
                                                wire:model="EDIT_correct_answer.{{ $question->id }}"
                                                name="EDIT_correct_answer" required
                                                @if (!$this->hasAtLeastTwoEDIT_choices($question->id)) disabled @endif
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:cursor-not-allowed">


                                                @if ($this->hasAtLeastTwoEDIT_choices($question->id))
                                                    <option value="">
                                                        Choose correct answer
                                                    </option>
                                                @endif

                                                @if (!$this->hasAtLeastTwoEDIT_choices($question->id))
                                                    <option value="">
                                                        --- Create Choices First ---
                                                    </option>
                                                @endif

                                                <!-- Show Choices when at least two choices have non-empty values -->
                                                @if ($this->hasAtLeastTwoEDIT_choices($question->id))
                                                    @foreach ($EDIT_choices[$question->id] as $choice)
                                                        @if (!empty($choice['choice']))
                                                            <option value="{{ $choice['choice'] }}"
                                                                @if ($EDIT_correct_answer[$question->id] == $choice['choice']) selected @endif>
                                                                {{ $choice['choice'] }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif


                                            </select>
                                            <x-input-error class="mt-2" :messages="$errors->get('EDIT_correct_answer')" />

                                            @error('EDIT_answer')
                                                <span class="space-y-1 text-sm text-red-600 dark:text-red-400">
                                                    <strong>Error:</strong> {{ $message }}
                                                </span>
                                            @enderror
                                        </div>



                                        {{-- Save and Cancel - of Edit Mode --}}
                                        <div wire:target="updateAQuestion({{ $question->id }})"
                                            class="flex items-center pb-6 m-2">
                                            <x-buttons.primary-button wire:loading.attr="disabled"
                                                wire:loading.class="opacity-50 cursor-not-allowed">
                                                {{ __('Save') }}
                                            </x-buttons.primary-button>

                                            <x-buttons.secondary-button class="mx-2" type="button"
                                                wire:click="cancelEditQuestion({{ $question->id }})"
                                                @click="questionID = ''">
                                                Cancel
                                            </x-buttons.secondary-button>
                                        </div>





                                        <div wire:loading wire:target="updateAQuestion">
                                            <div class="flex items-center">
                                                <div role="status">
                                                    <svg aria-hidden="true"
                                                        class="w-6 h-6 text-gray-200 me-2 animate-spin dark:text-gray-700 fill-gray-600"
                                                        viewBox="0 0 100 101" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                            fill="currentFill" />
                                                    </svg>
                                                </div>
                                                Updating your questions...
                                            </div>
                                        </div>
                                    </form>
                                    {{-- End of Edit Form --}}



                                </li>
                            </div>





                        @empty
                            <p class="italic text-center text-gray-300">No questions created yet.</p>
                        @endforelse


                    </ol>


                </div>
            </div>
        </div>
    </div>

</div>
