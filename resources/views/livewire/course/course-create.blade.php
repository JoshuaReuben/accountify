<div>

    {{-- START SECTION --}}

    {{-- Sweet Alert --}}
    @if (session()->has('message'))
        <x-sweet-alert :message="session('message')" />
    @endif



    <h1 class="text-xl font-bold uppercase">Create a New Course</h1>
    <form wire:submit.prevent="storeNewCourse" class="mt-6 space-y-6">
        {{-- COURSE NAME --}}
        <div>
            <x-input-label for="course_name" :value="__('Course Name')" class="uppercase" />
            <x-text-input wire:model="course_name" id="course_name" name="course_name" type="text"
                class="block w-full mt-1" required autofocus minLength="3" maxLength="150" />
            <x-input-error class="mt-2" :messages="$errors->get('course_name')" />
        </div>

        {{-- COURSE DESCRIPTION --}}
        <div>
            <x-input-label for="course_description" :value="__('COURSE DESCRIPTION')" class="uppercase" />
            <x-text-input wire:model="course_description" id="course_description" name="course_description"
                type="text" class="block w-full mt-1" required autofocus minLength="5" maxLength="255" />
            <x-input-error class="mt-2" :messages="$errors->get('course_description')" />
        </div>

        {{-- COURSE DIFFICULTY --}}
        <div>
            <x-input-label for="course_difficulty" :value="__('COURSE TARGET')" class="mb-2 uppercase" />
            {{-- <x-text-input wire:model="course_difficulty" id="course_difficulty" name="course_difficulty" type="text"
                class="block w-full mt-1" required autofocus minLength="3" maxLength="50" /> --}}

            <select id="course_difficulty" wire:model="course_difficulty" name="course_difficulty" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Choose difficulty</option>
                <option value="1ST YEAR">1ST YEAR</option>
                <option value="2ND YEAR">2ND YEAR</option>
                <option value="3RD YEAR">3RD YEAR</option>
                <option value="4TH YEAR">4TH YEAR</option>
            </select>


            <x-input-error class="mt-2" :messages="$errors->get('course_difficulty')" />
        </div>

        {{-- COURSE OVERVIEW --}}
        <div>
            <x-input-label for="course_overview" :value="__('COURSE OVERVIEW')" class="mb-1 uppercase" />
            {{-- TEXT BOX --}}
            <textarea wire:model="course_overview" id="course_overview" name="course_overview"
                class="block w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                required autofocus minLength="5" rows="4" placeholder="Overview Description of the Course..."></textarea>




            <x-input-error class="mt-2" :messages="$errors->get('course_overview')" />
        </div>

        {{-- COURSE COVER / IMAGE  --}}
        <div>
            <x-input-label for="course_cover_photo" :value="__('COURSE COVER PHOTO')" class="uppercase" />
            <x-text-input wire:model="course_cover_photo" id="course_cover_photo" name="course_cover_photo"
                accept="image/*" class="block w-full mt-1" type="file" required />
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help_for_course_cover_photo">Accepts
                JPEG, JPG, WEBP or PNG (Max. 4MB)
            </p>
            <p wire:loading wire:target="course_cover_photo" class="mt-1 text-xs text-gray-500 dark:text-gray-300">
                Uploading...</p>
            <x-input-error class="mt-2" :messages="$errors->get('course_cover_photo')" />
        </div>

        {{-- SHOW IMAGE PREVIEW --}}
        @if ($this->course_cover_photo)
            <div class="">
                <img class="h-[200px] max-w-md mx-auto rounded-lg" src="{{ $this->course_cover_photo->temporaryUrl() }}"
                    alt="Cover Photo">
                <p class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Image Preview</p>
            </div>
        @endif

        {{-- COURSE DURATION --}}
        <div>
            <x-input-label for="course_duration" :value="__('COURSE DURATION IN HOURS')" class="uppercase" />
            <x-text-input wire:model="course_duration" id="course_duration" name="course_duration" type="number"
                class="block w-full mt-1" required autofocus min="1" max="500" />
            <x-input-error class="mt-2" :messages="$errors->get('course_duration')" />
        </div>


        <div wire:target="course_cover_photo, storeNewCourse" class="flex items-center gap-4">
            <x-buttons.primary-button wire:loading.attr="disabled" wire:target="course_cover_photo, storeNewCourse"
                wire:loading.class="opacity-50 cursor-not-allowed">{{ __('Upload') }}</x-buttons.primary-button>
        </div>

        <div wire:loading wire:target="storeNewCourse">
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
                Uploading your files...
            </div>
        </div>
    </form>

    {{-- END SECTION --}}

</div>
