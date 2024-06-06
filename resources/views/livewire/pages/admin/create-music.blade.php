<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\Music;

new #[Layout('layouts.admin')] class extends Component {
    use WithFileUploads;

    public string $songtitle = '';
    public string $songartist = '';
    public $songcoverimage;
    public $songaudiofile;

    public function mount()
    {
        $this->songcoverimage = '';
        $this->songaudiofile = '';
    }

    public function storeANewSong()
    {
        $validated = $this->validate(
            [
                'songtitle' => 'required|string|min:3|max:200',
                'songartist' => 'required|string|min:3|max:200',
                'songcoverimage' => 'required|image|max:4096',
                'songaudiofile' => 'required|mimes:wav,mp3|max:8192',
            ],
            [
                // Custom validation messages
                'songcoverimage.required' => 'The Cover Photo is required.',
                'songaudiofile.required' => 'The Uploaded Audio is required.',
                'songcoverimage.mimes' => 'The Cover Photo must be a file of type: jpeg, jpg, png, webp.',
                'songaudiofile.mimes' => 'The Uploaded Audio must be a .wav or .mp3 file.',
            ],
        );
        dd('success');
        //$this->dispatch('new-song-uploaded');
    }
};

?>

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{-- START - BREADCRUMBS --}}
            <x-admin-breadcrumbs />
            {{-- END - BREADCRUMBS --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}

                    <form wire:submit="storeANewSong" class="mt-6 space-y-6">
                        {{-- SONG TITLE --}}
                        <div>
                            <x-input-label for="songtitle" :value="__('Song Title')" class="uppercase" />
                            <x-text-input wire:model="songtitle" id="songtitle" name="songtitle" type="text"
                                class="block w-full mt-1" required autofocus minLength="3" maxLength="200" />
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
                            <x-text-input wire:model="songcoverimage" id="songcoverimage" name="songcoverimage"
                                accept="image/*" class="block w-full mt-1" type="file" required />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300"
                                id="file_input_help_for_cover_photo">Accepts JPEG, JPG, WEBP or PNG (Max. 4MB)
                            </p>
                            <p wire:loading wire:target="songcoverimage"
                                class="mt-1 text-xs text-gray-500 dark:text-gray-300">Uploading...</p>
                            <x-input-error class="mt-2" :messages="$errors->get('songcoverimage')" />
                        </div>

                        {{-- UPLOAD SONG / AUDIO FILE --}}
                        <div>
                            <x-input-label for="songaudiofile" :value="__('Upload Audio')" class="uppercase" />
                            <x-text-input wire:model="songaudiofile" id="songaudiofile" name="songaudiofile"
                                type="file" accept="audio/wav, audio/mpeg, audio/mp3" class="block w-full mt-1"
                                required />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help_for_audio">
                                Accepts .wav and .mp3
                                file only.
                            </p>
                            <p wire:loading wire:target="songaudiofile"
                                class="mt-1 text-xs text-gray-500 dark:text-gray-300">Uploading...</p>
                            <x-input-error class="mt-2" :messages="$errors->get('songaudiofile')" />
                        </div>


                        <div class="flex items-center gap-4">
                            <x-buttons.primary-button>{{ __('Upload') }}</x-buttons.primary-button>

                            <x-action-message class="me-3" on="new-song-uploaded">
                                {{ __('New Song Uploaded.') }}
                            </x-action-message>
                        </div>
                    </form>

                    {{-- END SECTION --}}


                    {{-- ---------------------- --}}
                </div>
            </div>
        </div>
    </div>
</div>
