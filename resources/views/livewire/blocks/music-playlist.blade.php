<?php

use Livewire\Volt\Component;
use App\Models\Music;
use Livewire\Attributes\On;

new class extends Component {
    public $songs = [];
    public $ARR_songs = [];

    public $songs_title = [];
    public $songs_artist = [];
    public $songs_cover_photo = [];
    public $songs_filepath = [];

    public function mount()
    {
        $this->songs = Music::all();
        $this->ARR_songs = $this->songs->toArray();

        foreach ($this->songs as $song) {
            $this->songs_title[] = $song->song_title;
            $this->songs_artist[] = $song->song_artist;
            $this->songs_cover_photo[] = $song->song_cover_photo;
            $this->songs_filepath[] = $song->song_file_path;
        }
    }
}; ?>


<div>

    {{-- MUSIC PLAYER ----------------------------------------------------------------------------------------------------------- --}}
    <div>

        {{-- Music Layout Design --}}
        <div class="w-full" x-data="setupMusicPlayer({{ json_encode($ARR_songs) }})">

            {{-- put code here --}}
            <div
                class='flex w-full mx-auto overflow-hidden bg-gray-100 shadow-md dark:bg-gray-800 dark:ring-1 dark:ring-gray-600 drop-shadow-2xl rounded-xl '>

                {{-- Show if Music Count is Greater than 0 --}}
                @if (count($this->songs) > 0)
                    <div class="flex flex-col w-full">
                        <div class="flex p-5 border-b">
                            <img id="musicCoverPhoto" class='object-cover w-20 h-20' alt='Music Cover Photo'
                                :src="currentMusic_Cover">
                            <div class="flex flex-col w-full px-2">

                                {{-- Status --}}
                                <span id="musicStatus"
                                    class="text-xs font-medium text-gray-700 uppercase dark:text-white ">
                                    <span x-show="isMusicPlaying == true">Playing</span>
                                    <span x-show="isMusicPlaying == false">Paused</span>
                                </span>

                                {{-- Title --}}
                                <span x-text="currentMusic_Title" id="musicTitle"
                                    class="pt-1 text-sm font-semibold text-green-500 capitalize">
                                    Display The Current Music Title
                                </span>

                                {{-- Author --}}
                                <span x-text="currentMusic_Author" id="musicAuthor"
                                    class="text-xs font-medium text-gray-500 dark:text-gray-400 ">
                                    Display The Current Music Author
                                </span>
                            </div>
                        </div>


                        <div class="flex flex-col-reverse items-center p-5">
                            <div class="flex items-center">
                                <div class="flex p-2 mt-2 space-x-3">
                                    {{-- Previous --}}
                                    <button @click="previousMusic" class="group focus:outline-none hover:scale-125">
                                        <i
                                            class="text-2xl text-green-400 transition fa-solid fa-backward-step group-hover:text-green-500 "></i>
                                    </button>

                                    {{-- Play Button --}}
                                    <button @click="toggleMusic()"
                                        class=" group rounded-full focus:outline-none w-14 h-14 flex items-center justify-center pl-0.5 ring-1 ring-green-400 hover:ring-green-500 hover:ring-2">
                                        <i class="text-2xl text-green-400 fa-solid group-hover:text-green-500 group-hover:scale-125"
                                            x-bind:class="isMusicPlaying ? 'fa-pause' : 'fa-play'"></i>
                                    </button>

                                    {{-- Next --}}
                                    <button @click="nextMusic" class=" group focus:outline-none hover:scale-125">
                                        <i
                                            class="text-2xl text-green-400 transition fa-solid fa-forward-step group-hover:text-green-500 "></i>
                                    </button>
                                </div>
                            </div>

                            <div class="relative w-full ml-2">
                                {{-- Music Progress Slider --}}
                                <input x-ref="music_ProgressSlider" id="music-progress-slider" type="range"
                                    value="0" class="">
                            </div>

                            <div class="flex justify-end w-full pt-1 sm:pt-0">
                                {{-- Time --}}
                                <span x-ref="musicCurrentTime" id="musicCurrentTime"
                                    class="pl-2 text-xs font-medium text-gray-700 uppercase dark:text-white">
                                    <span x-text="currentMusic_CurrentTime"></span> / <span
                                        x-text="currentMusic_Duration"></span>
                                </span>
                            </div>

                        </div>

                        <div class="flex flex-col p-5">
                            {{-- Volume Adjuster --}}
                            <div class="flex items-center justify-between pb-1 mb-2 border-b">
                                <span class="text-base font-semibold text-gray-700 uppercase dark:text-white"> play
                                    list</span>
                                <span class="flex items-center space-x-2">
                                    <i id="volumeIconForMusic" class="fa-solid text-slate-500 dark:text-white"
                                        x-bind:class="{
                                            'fa-volume-high': isMuted == false,
                                            'fa-volume-xmark': isMuted == true,
                                        }"></i>
                                    <input x-ref="volume_slider" type="range" id="musicVolumeControl" min="0"
                                        max="1" step="0.01" value="0.9"
                                        style="accent-color: rgb(74 222 128);">
                                    {{-- Label --}}
                                    <span id="musicCurrentVolumeTxt" x-text="displayed_volume"
                                        class="text-xs font-medium text-gray-700 uppercase dark:text-white">
                                        90
                                    </span>
                                </span>

                            </div>

                            {{-- Playlist --}}
                            <div class="flex flex-col h-[40vh] overflow-y-auto">
                                @foreach ($songs as $song) 
                                    <div @click="playSelectedSong({{ $loop->iteration }})"
                                        class="flex px-2 py-3 transition-all duration-100 ease-in border-b cursor-pointer song-playlist dark:border dark:border-gray-700 hover:shadow-sm hover:bg-gray-100 hover:rounded-xl dark:hover:bg-gray-900">
                                        {{-- Avatar --}}
                                        <img class='object-cover w-10 h-10 rounded-lg' alt='User avatar'
                                            src='/storage/{{ $song->song_cover_photo }}'>
                                        <div class="flex flex-col w-full px-2">

                                            <span class="pt-1 text-sm font-semibold text-green-500 capitalize">
                                                {{ $song->song_title }}
                                            </span>
                                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 ">
                                                - {{ $song->song_artist }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                        </div>
                    </div>
                @else
                    {{-- No songs found --}}
                    <div
                        class="text-sm font-medium text-gray-500 dark:text-gray-400 text-center mx-auto h-[200px] flex items-center">
                        No songs found
                    </div>
                @endif
            </div>

        </div>


        <script data-navigate-once>
            function setupMusicPlayer(passed_songs) {
                return {
                    // Initial data
                    song_Titles: [],
                    song_Artists: [],
                    song_Covers: [],
                    song_Paths: [],
                    song_Counts: null,

                    currentMusicIndex: 0,
                    isMusicPlaying: false,
                    isMuted: false,


                    currentMusic_Title: 'Music Title',
                    currentMusic_Author: 'Music Author',
                    currentMusic_Cover: '',
                    currentMusic_Duration: '--:--',
                    currentMusic_CurrentTime: '00:00',

                    // Music On Start
                    musicAudio: null,

                    // Volume
                    displayed_volume: null,


                    // Initialize
                    init() {
                        if (!passed_songs.length) return; // Fail the init if there are no songs

                        // Receive Params and Set the variables
                        this.song_Titles = passed_songs.map(song => song.song_title);
                        this.song_Artists = passed_songs.map(song => song.song_artist);
                        this.song_Covers = passed_songs.map(song => song.song_cover_photo);
                        this.song_Paths = passed_songs.map(song => song.song_file_path);
                        this.song_Counts = passed_songs.length;

                        this.musicAudio = new Audio('/audio/' + this.song_Paths[this.currentMusicIndex]);
                        this.displayed_volume = Math.floor((this.musicAudio.volume * 100)) + '%';




                        this.musicAudio.onloadedmetadata = () => {
                            this.$refs.music_ProgressSlider.max = this.musicAudio.duration;
                            this.$refs.music_ProgressSlider.value = this.musicAudio.currentTime;

                            this.currentMusic_Title = this.song_Titles[this.currentMusicIndex];
                            this.currentMusic_Author = this.song_Artists[this.currentMusicIndex];
                            this.currentMusic_Cover = '/storage/' + this.song_Covers[this.currentMusicIndex];
                            this.currentMusic_Duration = this.formatMusicTime(this.musicAudio.duration);


                        };

                        this.musicAudio.onended = () => {
                            this.nextMusic();
                        };

                        this.musicAudio.onplaying = () => {
                            this.isMusicPlaying = true;

                        };


                        this.musicAudio.ontimeupdate = () => {
                            this.currentMusic_CurrentTime = this.formatMusicTime(this.musicAudio.currentTime);
                            this.$refs.music_ProgressSlider.value = this.musicAudio.currentTime;
                        };



                        // On Slider Change -> Adjust Current Music Time
                        this.$refs.music_ProgressSlider.oninput = () => {
                            this.musicAudio.currentTime = this.$refs.music_ProgressSlider.value;
                        };


                        // On Volume Change
                        this.$refs.volume_slider.onchange = () => {
                            this.musicAudio.volume = this.$refs.volume_slider.value;
                            this.displayed_volume = Math.floor((this.musicAudio.volume * 100)) + '%';
                            this.isMuted = this.musicAudio.volume == 0 ? true : false;
                        }

                    }, // End of Init()



                    toggleMusic() {
                        if (this.isMusicPlaying) {
                            // Playing -> Paused
                            this.musicAudio.pause();
                            this.isMusicPlaying = false;
                        } else {
                            // Paused -> Playing
                            this.musicAudio.play();
                            this.isMusicPlaying = true;
                        }
                    },

                    formatMusicTime(seconds) {
                        let minutes = Math.floor(seconds / 60);
                        let remainingSeconds = Math.floor(seconds % 60);
                        return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
                    },



                    nextMusic() {
                        this.currentMusicIndex++;
                        if (this.currentMusicIndex < this.song_Counts) {
                            this.musicAudio.src = '/audio/' + this.song_Paths[this.currentMusicIndex];
                            this.musicAudio.play();
                        } else {
                            this.currentMusicIndex = 0;
                            this.musicAudio.src = '/audio/' + this.song_Paths[this.currentMusicIndex];
                            this.musicAudio.play();
                        }
                    },

                    previousMusic() {
                        if (this.currentMusicIndex > 0) {
                            this.currentMusicIndex--;
                            this.musicAudio.src = '/audio/' + this.song_Paths[this.currentMusicIndex];
                            this.musicAudio.play();
                        } else {
                            this.currentMusicIndex = this.song_Counts - 1;
                            this.musicAudio.src = '/audio/' + this.song_Paths[this.currentMusicIndex];
                            this.musicAudio.play();
                        }
                    },

                    playSelectedSong(index) {
                        // Before changing song, pause audio if playing
                        if (this.isMusicPlaying) {
                            this.musicAudio.pause();
                            this.isMusicPlaying = false;
                        }
                        this.currentMusicIndex = index - 1;
                        this.musicAudio.src = '/audio/' + this.song_Paths[this.currentMusicIndex];
                        this.musicAudio.play();
                        this.toggleMusic();
                    },

                }
            }
        </script>

    </div>


</div>
