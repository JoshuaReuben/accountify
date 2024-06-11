<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\Music;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Kiwilan\Audio\Audio;
use Illuminate\Support\Facades\Storage;

new #[Layout('layouts.admin')] class extends Component {
    use WithFileUploads;

    public string $songtitle = '';
    public string $songartist = '';
    public $songcoverimage;
    public $songaudiofile;

    public $music_search = '';

    public $songs;

    public function mount()
    {
        $this->songcoverimage = '';
        $this->songaudiofile = '';

        $this->songs = Music::all();
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
                'songaudiofile.required' => 'The Audio is not yet properly uploaded. Please try again.',
                'songcoverimage.mimes' => 'The Cover Photo must be a file of type: jpeg, jpg, png, webp.',
                'songaudiofile.mimes' => 'The Uploaded Audio must be a .wav or .mp3 file.',
            ],
        );

        //Get The File Name and Extension then Sanitize
        $coverphoto_filename = $this->songcoverimage->getClientOriginalName();
        $music_filename = $this->songaudiofile->getClientOriginalName();

        //Get The Base Name
        $coverphoto_basename = pathinfo($coverphoto_filename, PATHINFO_FILENAME);
        $music_basename = pathinfo($music_filename, PATHINFO_FILENAME);

        //Get The Extension
        $coverphoto_ext = pathinfo($coverphoto_filename, PATHINFO_EXTENSION);
        $music_ext = pathinfo($music_filename, PATHINFO_EXTENSION);

        //Sanitize the Base Name using Filter Var of FILTER_SANITIZE_STRING then assign back value to orig var
        $coverphoto_filename = filter_var($coverphoto_basename, FILTER_SANITIZE_STRING);
        $music_filename = filter_var($music_basename, FILTER_SANITIZE_STRING);

        //Add Unique Identifiers to the Base Name
        $coverphoto_filename = $coverphoto_filename . '-' . uniqid();
        $music_filename = $music_filename . '-' . uniqid();

        //Merge Back the Extension for the Final File Name
        $coverphoto_filename = $coverphoto_filename . '.' . $coverphoto_ext;
        $music_filename = $music_filename . '.' . $music_ext;

        ////////////////////////// STORING THE MUSIC TO DATABASE

        $music_saved_file_path = $this->songaudiofile->storeAs('musics', $music_filename, 'public');

        //Get the metadata of the song

        //Get the audio path
        $fullUrl = 'storage/' . $music_saved_file_path;
        $audio = Audio::get($fullUrl);

        $audio_filesize = $audio->getAudio()->getFilesize();
        //convert the filesize into mb
        $audio_filesize_in_MB = round($audio_filesize / 1024 / 1024, 2);
        $audio_filesize_in_MB = $audio_filesize_in_MB . ' MB';

        $audio_duration = $audio->getDuration();
        // convert the duration into minutes and seconds
        $audio_duration = gmdate('i:s', $audio_duration);

        //Store the song in the database
        $song = Music::create([
            'song_title' => $this->songtitle,
            'song_artist' => $this->songartist,
            'song_cover_photo' => $this->songcoverimage->storeAs('musics_cover_photos', $coverphoto_filename, 'public'),
            'song_file_path' => $music_saved_file_path,
            'song_duration' => $audio_duration,
            'song_filesize' => $audio_filesize_in_MB,
        ]);

        ////////////////////////// Get the File Size and File Duration //////////////////////////

        $this->reset(['songtitle', 'songartist', 'songcoverimage', 'songaudiofile']);
        $this->dispatch('new-song-uploaded');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // TABLE LIST OF MUSICS

    #[On('new-song-uploaded')]
    public function updateMusicList()
    {
        $this->songs = Music::all();
    }

    public function deleteSong(Music $music)
    {
        $fileExists = Storage::exists('public/' . $music->song_file_path);
        // dd($fileExists);
        if ($fileExists) {
            Storage::delete('public/' . $music->song_cover_photo);
            Storage::delete('public/' . $music->song_file_path);
        } else {
            //reload the browser
            return redirect()->back();
            exit();
        }

        $music->delete();
        $this->updateMusicList();
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

    <div class="py-6">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}
                    <h1 class="text-xl font-bold uppercase">Upload a New Song</h1>
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

                        {{-- SHOW IMAGE PREVIEW --}}
                        @if ($this->songcoverimage)
                            <div class="">
                                <img class="h-[200px] max-w-md mx-auto rounded-lg"
                                    src="{{ $this->songcoverimage->temporaryUrl() }}" alt="Cover Photo">
                                <p class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Image Preview</p>
                            </div>
                        @endif


                        {{-- UPLOAD SONG / AUDIO FILE --}}
                        <div>
                            <x-input-label for="songaudiofile" :value="__('Upload Audio')" class="uppercase" />
                            <x-text-input wire:model="songaudiofile" id="songaudiofile" name="songaudiofile"
                                type="file" accept="audio/wav, audio/mpeg, audio/mp3" class="block w-full mt-1"
                                required />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help_for_audio">
                                Accepts .wav and .mp3
                                file only. (Max. 8MB)
                            </p>
                            <p wire:loading wire:target="songaudiofile"
                                class="mt-1 text-xs text-gray-500 dark:text-gray-300">Uploading...</p>
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

                            <x-action-message class="me-3" on="new-song-uploaded">
                                {{ __('New Song Uploaded.') }}
                            </x-action-message>
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
            </div>
        </div>
    </div>




    <div class="py-6">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-xl font-bold uppercase mb-4">PLAYLIST OF SONGS</h1>
                    {{-- START SECTION 2 --}}



                    <div class="relative  shadow-md sm:rounded-lg">
                        <div class="flex items-center justify-end space-y-4 pb-4 bg-white dark:bg-gray-800">

                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="table-search-musics"
                                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-48 md:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search for musics">
                            </div>

                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  ">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Cover Photo
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Artist
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Duration
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Size
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($songs as $song)
                                        <tr wire:loading.class="hidden" wire:target="storeANewSong, deleteSong"
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                                            <td class="px-6 py-4">
                                                <img class="w-10 h-10 rounded-lg"
                                                    src="/storage/{{ $song->song_cover_photo }}" alt="">
                                            </td>

                                            <td class="px-6 py-4 text-sm lg:text-md ">
                                                {{ $song->song_title }}
                                            </td>
                                            <td class="px-6 py-4 text-sm lg:text-md">
                                                {{ $song->song_artist }}
                                            </td>
                                            <td class="px-6 py-4 text-sm lg:text-md">
                                                {{ $song->song_duration }}
                                            </td>
                                            <td class="px-6 py-4 text-sm lg:text-md">
                                                {{ $song->song_filesize }}
                                            </td>
                                            <td class="px-6 py-4 text-center">

                                                {{-- Edit --}}
                                                <button class="font-medium text-blue-600 dark:text-blue-500">
                                                    <i class="fa-solid fa-pen-to-square text-md lg:text-lg mx-1 "></i>
                                                </button>

                                                {{-- Delete --}}
                                                <button wire:confirm="Are you sure you want to delete this song?"
                                                    wire:click="deleteSong({{ $song->id }})"
                                                    class="font-medium text-red-600 dark:text-red-500">
                                                    <i class="fa-solid fa-trash-can text-md lg:text-lg mx-1 "></i>
                                                </button>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td colspan="6" class="px-6 py-4">
                                                <p class="text-sm lg:text-md text-center italic">No songs found.</p>
                                            </td>
                                        </tr>
                                    @endforelse



                                </tbody>
                            </table>
                        </div>

                    </div>

                    {{-- END SECTION  2 --}}

                </div>
            </div>
        </div>
    </div>


</div>
