<div>

    {{-- START SECTION --}}

    {{-- Sweet Alert --}}
    @if (session()->has('message'))
        <x-sweet-alert :message="session('message')" />
    @endif



    <h1 class="text-xl font-bold uppercase">Upload a New Song</h1>
    <form wire:submit.prevent="storeANewSong" class="mt-6 space-y-6">
        {{-- SONG TITLE --}}
        <div>
            <x-input-label for="songtitle" :value="__('Song Title')" class="uppercase" />
            <x-text-input wire:model="songtitle" id="songtitle" name="songtitle" type="text" class="block w-full mt-1"
                required autofocus minLength="3" maxLength="200" />
            <x-input-error class="mt-2" :messages="$errors->get('songtitle')" />
        </div>

        {{-- SONG ARTIST --}}
        <div>
            <x-input-label for="songartist" :value="__('Song Artist')" class="uppercase" />
            <x-text-input wire:model="songartist" id="songartist" name="songartist" type="text"
                class="block w-full mt-1" required autofocus minLength="3" maxLength="200" />
            <x-input-error class="mt-2" :messages="$errors->get('songartist')" />
        </div>

        {{-- SONG COVER / IMAGE PREVIEW --}}
        <div>
            <x-input-label for="songcoverimage" :value="__('Cover Photo')" class="uppercase" />
            <x-text-input wire:model="songcoverimage" id="songcoverimage" name="songcoverimage" accept="image/*"
                class="block w-full mt-1" type="file" required />
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help_for_cover_photo">Accepts
                JPEG, JPG, WEBP or PNG (Max. 4MB)
            </p>
            <p wire:loading wire:target="songcoverimage" class="mt-1 text-xs text-gray-500 dark:text-gray-300">
                Uploading...</p>
            <x-input-error class="mt-2" :messages="$errors->get('songcoverimage')" />
        </div>

        {{-- SHOW IMAGE PREVIEW --}}
        @if ($this->songcoverimage)
            <div class="">
                <img class="h-[200px] max-w-md mx-auto rounded-lg" src="{{ $this->songcoverimage->temporaryUrl() }}"
                    alt="Cover Photo">
                <p class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Image Preview</p>
            </div>
        @endif


        {{-- UPLOAD SONG / AUDIO FILE --}}
        <div>
            <x-input-label for="songaudiofile" :value="__('Upload Audio')" class="uppercase" />
            <x-text-input wire:model="songaudiofile" id="songaudiofile" name="songaudiofile" type="file"
                accept="audio/wav, audio/mpeg, audio/mp3" class="block w-full mt-1" required />
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help_for_audio">
                Accepts .wav and .mp3
                file only. (Max. 8MB)
            </p>
            <p wire:loading wire:target="songaudiofile" class="mt-1 text-xs text-gray-500 dark:text-gray-300">
                Uploading...</p>
            <x-input-error class="mt-2" :messages="$errors->get('songaudiofile')" />
        </div>

        {{-- AUDIO PREVIEW --}}
        <div>
            @if ($this->songaudiofile)
                <audio class="w-full mt-1 rounded-lg" controls>
                    <source src="{{ $this->songaudiofile->temporaryUrl() }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <p class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Audio Preview</p>
            @endif
        </div>


        <div wire:target="songaudiofile, songcoverimage, storeANewSong" class="flex items-center gap-4">
            <x-buttons.primary-button wire:loading.attr="disabled"
                wire:target="songaudiofile, songcoverimage, storeANewSong"
                wire:loading.class="opacity-50 cursor-not-allowed">{{ __('Upload') }}</x-buttons.primary-button>
        </div>

        <div wire:loading wire:target="storeANewSong">
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
