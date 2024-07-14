<div>


    {{-- Sweet Alert --}}
    @if (session()->has('message'))
        <x-sweet-alert :message="session('message')" />
    @endif


    <x-sweet-alert-2 on="flashcard-added" message="Flashcard Added Successfully" />
    <x-sweet-alert-2 on="flashcard-deleted" message="Flashcard Deleted Successfully" />
    <x-sweet-alert-2 on="flashcard-updated" message="Flashcard Updated Successfully" />




    <x-slot name="header">
        <div class="flex justify-between w-full">
            <div class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('LESSON  ') }}{{ $lesson_position . ' | ' . $passed_lesson->lesson_title }}
            </div>
            <div>
                {{-- Back to Lesson --}}
                <a href="{{ route('pages.admin.lesson.show', ['courseID' => $courseID, 'moduleID' => $moduleID, 'lessonID' => $passed_lesson->id]) }}"
                    class=" focus:outline-none text-white font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">
                    &nbsp; <i class="text-2xl fa-solid fa-xmark"></i>
                </a>
            </div>
        </div>

    </x-slot>

    <x-slot name="sidebarContent">
        <livewire:layout.resource-sidebar-for-lessons courseID="{{ $courseID }}" moduleID="{{ $moduleID }}" />
    </x-slot>

    {{-- FLASH CARDS --}}


    {{-- Show if flashcard is created --}}
    @if ($passed_lesson->flashcards()->count() > 0)
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{--  --}}
                        <div x-data="setupCarousel(@entangle('ARR_fetched_flashcards'))" class="relative w-full h-full overflow-hidden">

                            <!-- previous button -->
                            <button type="button"
                                class="absolute z-20 flex items-center justify-center p-2 transition -translate-y-1/2 rounded-full left-5 top-1/2 bg-white/40 text-slate-700 hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                                aria-label="previous slide" x-on:click="previous()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                    fill="none" stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 19.5 8.25 12l7.5-7.5" />
                                </svg>
                            </button>

                            <!-- next button -->
                            <button type="button"
                                class="absolute z-20 flex items-center justify-center p-2 transition -translate-y-1/2 rounded-full right-5 top-1/2 bg-white/40 text-slate-700 hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                                aria-label="next slide" x-on:click="next()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                    fill="none" stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>

                            <!-- slides -->
                            <div
                                class="relative min-h-[400px] md:min-h-[600px] w-full flex justify-center items-center">

                                @foreach ($ARR_fetched_flashcards as $key => $slide)
                                    <div x-show="currentSlideIndex == {{ $key }} + 1" class="absolute "
                                        x-transition.opacity.duration.1000ms>

                                        <x-flashcard question="{{ $slide['flashcard_question'] }}"
                                            answer=" {{ $slide['flashcard_answer'] }}" />

                                    </div>
                                @endforeach

                            </div>

                            <div class="w-full text-center ">
                                <p><span x-text="currentSlideIndex"></span> / {{ $fetched_flashcards->count() }}</p>
                                <p class="font-normal text-gray-700 dark:text-gray-400">Flashcards - Click to Flip
                                </p>
                            </div>


                        </div>

                        {{--  --}}
                    </div>
                </div>
            </div>
        </div>
    @endif





    {{-- 1ST SECTION - CREATE FLASHCARD --}}
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}


                    <h1 class="text-xl font-bold uppercase">Create Flash Cards</h1>
                    <form wire:submit.prevent="storeFlashcard" class="mt-6 space-y-6">

                        {{-- Flashcard Question --}}
                        <div class="pb-6">
                            <x-input-label for="flashcard_question" :value="__('Question')" class="mb-1 uppercase" />
                            {{-- TEXT BOX --}}
                            <textarea wire:model.live="flashcard_question" id="flashcard_question" name="flashcard_question"
                                class="block w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                required autofocus minLength="3" maxlength="500" rows="3" placeholder="Put the Question here..."></textarea>

                            <x-input-error class="mt-2" :messages="$errors->get('flashcard_question')" />
                        </div>


                        {{-- Flashcard Answer --}}
                        <div class="pb-6">
                            <x-input-label for="flashcard_answer" :value="__('Answer')" class="mb-1 uppercase" />
                            {{-- TEXT BOX --}}
                            <textarea wire:model.live="flashcard_answer" id="flashcard_answer" name="flashcard_answer"
                                class="block w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                required autofocus minLength="3" maxlength="500" rows="3" placeholder="Put the Answer here..."></textarea>

                            <x-input-error class="mt-2" :messages="$errors->get('flashcard_answer')" />
                        </div>




                        <div wire:target="storeFlashcard" class="flex items-center gap-4">
                            <x-buttons.primary-button wire:loading.attr="disabled"
                                wire:loading.class="opacity-50 cursor-not-allowed">{{ __('Add') }}</x-buttons.primary-button>
                        </div>

                        <div wire:loading wire:target="storeFlashcard">
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
                                Saving your Flashcard...
                            </div>
                        </div>
                    </form>


                    {{-- ---------------------- --}}
                </div>
            </div>
        </div>
    </div>



    {{-- 2ND SECTION - DISPLAY FLASHCARDS (TABLE) --}}
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div x-data="{ mode: 'view', flashcardID: '' }" x-on:flashcard-updated.window="flashcardID = ''"
                    class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-xl font-bold uppercase">QUESTION LIST:</h1>
                        </div>
                        <div>


                            {{-- Edit --}}
                            <button type="button" @click="mode = 'edit'"
                                x-show="(mode === 'view') || (mode === 'edit')"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                :class="{ 'opacity-50 cursor-not-allowed': mode === 'edit' }">
                                Edit Flashcard &nbsp; <i class="fa-solid fa-pencil"></i>
                            </button>

                            {{-- Delete --}}
                            <button type="button" @click="mode = 'delete'"
                                x-show="(mode === 'view') || (mode === 'delete')"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                :class="{ 'opacity-50 cursor-not-allowed': mode === 'delete' }">
                                Delete Flashcard &nbsp; <i class="fa-solid fa-trash-can"></i>
                            </button>

                            {{-- Back To Menu --}}
                            <button type="button" @click="mode = 'view'; flashcardID = ''"
                                x-show="mode != 'view' && (flashcardID == '')"
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 disabled:hidden">
                                Normal View &nbsp; <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>

                    </div>


                    <hr class="mb-4">


                    {{-- List --}}
                    <div class="space-y-4 text-gray-500 break-words dark:text-gray-100 ">

                        @forelse ($fetched_flashcards as $flashcard)
                            {{-- ------------------------ --}}
                            <div wire:key="{{ $flashcard->id }}" class="flex w-full break-words ">
                                {{-- Edit Icon --}}
                                <span class="me-2 "
                                    x-show="mode == 'edit' && (flashcardID !== {{ $flashcard->id }})">
                                    <button type="button" @click="flashcardID = {{ $flashcard->id }}"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <i class="text-xs fa-solid fa-pencil"></i>
                                    </button>
                                </span>

                                {{-- Delete Icon --}}
                                <span class="me-2" x-show="mode == 'delete'">
                                    <button type="button"
                                        wire:confirm="Are you sure you want to delete this Flashcard?"
                                        wire:click="deleteFlashcard({{ $flashcard->id }})"
                                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 focus:outline-none">
                                        <i class="text-xs fa-solid fa-minus"></i>
                                    </button>
                                </span>


                                {{-- Display The Flashcard Question --}}
                                <form class="w-full" wire:submit.prevent="updateAFlashcard({{ $flashcard->id }})">
                                    <div
                                        class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ">
                                        <span
                                            class=" mb-5 inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            Question {{ $loop->iteration }}
                                        </span>


                                        {{-- View Mode of Question --}}
                                        <h5 x-show=" (mode == 'delete') || (mode == 'view') || ((mode == 'edit') && (flashcardID != {{ $flashcard->id }}))"
                                            class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                            {{ $flashcard->flashcard_question }}
                                        </h5>

                                        {{-- Edit Mode of Question --}}
                                        <div x-show="(flashcardID == {{ $flashcard->id }})" class="pb-6">
                                            <x-input-label for="EDIT_flashcard_question.{{ $flashcard->id }}"
                                                :value="__('Edit Question:')" class="mb-1 uppercase" />
                                            {{-- TEXT BOX --}}
                                            <textarea wire:model.live="EDIT_flashcard_question.{{ $flashcard->id }}"
                                                id="EDIT_flashcard_question.{{ $flashcard->id }}" name="EDIT_flashcard_question.{{ $flashcard->id }}"
                                                class="block w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                                required autofocus minLength="3" maxlength="500" rows="3" placeholder="Put the Question here...">{{ $EDIT_flashcard_question[$flashcard->id] }}</textarea>

                                            <x-input-error class="mt-2" :messages="$errors->get('EDIT_flashcard_question.{{ $flashcard->id }}')" />
                                        </div>

                                        <hr class="my-4 dark:border-gray-700">

                                        {{-- View Mode of Answer --}}
                                        <p x-show=" (mode == 'delete') || (mode == 'view') || ((mode == 'edit') && (flashcardID != {{ $flashcard->id }}))"
                                            class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                                            <strong class="text-gray-900 dark:text-white"> Answer: </strong>
                                            {{ $flashcard->flashcard_answer }}
                                        </p>

                                        {{-- Edit Mode of Answer --}}
                                        <div x-show="(flashcardID == {{ $flashcard->id }})" class="pb-6">
                                            <x-input-label for="EDIT_flashcard_answer.{{ $flashcard->id }}"
                                                :value="__('Edit Answer:')" class="mb-1 uppercase" />
                                            {{-- TEXT BOX --}}
                                            <textarea wire:model.live="EDIT_flashcard_answer.{{ $flashcard->id }}"
                                                id="EDIT_flashcard_answer.{{ $flashcard->id }}" name="EDIT_flashcard_answer.{{ $flashcard->id }}"
                                                class="block w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                                required autofocus minLength="3" maxlength="500" rows="3" placeholder="Put the Answer here...">{{ $EDIT_flashcard_answer[$flashcard->id] }}</textarea>

                                            <x-input-error class="mt-2" :messages="$errors->get('EDIT_flashcard_answer.{{ $flashcard->id }}')" />
                                        </div>


                                        {{-- Save and Cancel - of Edit Mode --}}
                                        <div x-show="(flashcardID == {{ $flashcard->id }})"
                                            wire:target="updateAFlashcard({{ $flashcard->id }})"
                                            class="flex items-center pb-6 m-2 mt-2">
                                            <x-buttons.primary-button wire:loading.attr="disabled"
                                                wire:loading.class="opacity-50 cursor-not-allowed">
                                                {{ __('Save') }}
                                            </x-buttons.primary-button>

                                            <x-buttons.secondary-button class="mx-2" type="button"
                                                wire:click="cancel_EDIT_Flashcard({{ $flashcard->id }})"
                                                @click="flashcardID = ''">
                                                Cancel
                                            </x-buttons.secondary-button>

                                            <div wire:loading wire:target="updateAFlashcard">
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
                                                    Updating your Flashcard...
                                                </div>
                                            </div>

                                        </div>

                                    </div>






                                </form>

                                {{-- End of the Flashcard Display --}}


                            </div>


                        @empty
                            <p class="italic text-center text-gray-300">No Flashcards created yet.</p>
                        @endforelse


                    </div>


                </div>
            </div>
        </div>
    </div>


    <script>
        function setupCarousel(mySlides) {

            return {
                slides: mySlides,
                currentSlideIndex: 1,
                previous() {
                    if (this.currentSlideIndex > 1) {
                        this.currentSlideIndex = this.currentSlideIndex - 1
                    } else {
                        // If it's the first slide, go to the last slide           
                        this.currentSlideIndex = this.slides.length
                    }
                },
                next() {
                    if (this.currentSlideIndex < this.slides.length) {
                        this.currentSlideIndex = this.currentSlideIndex + 1
                    } else {
                        // If it's the last slide, go to the first slide    
                        this.currentSlideIndex = 1
                    }
                },
            }
        }
    </script>

</div>
