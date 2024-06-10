<?php

use Livewire\Volt\Component;
use App\Models\Music;

new class extends Component {
    // public $song_title;
    // public $song_artist;
    // public $song_cover_photo;
    // public $song_file_path;

    public $songs = [];

    public $songs_title = [];
    public $songs_artist = [];
    public $songs_cover_photo = [];
    public $songs_filepath = [];

    public function mount()
    {
        $this->songs = Music::all();

        foreach ($this->songs as $song) {
            $this->songs_title[] = $song->song_title;
            $this->songs_artist[] = $song->song_artist;
            $this->songs_cover_photo[] = $song->song_cover_photo;
            $this->songs_filepath[] = $song->song_file_path;
        }

        $this->songs_filepath = json_encode($this->songs_filepath);
        $this->songs_title = json_encode($this->songs_title);
        $this->songs_artist = json_encode($this->songs_artist);
        $this->songs_cover_photo = json_encode($this->songs_cover_photo);
    }
}; ?>


<div>

    <div>

        {{-- Music Layout Design --}}
        <div class="w-full ">
            <div
                class='flex w-full mx-auto overflow-hidden bg-gray-100 shadow-md dark:bg-gray-800 dark:ring-1 dark:ring-gray-600 drop-shadow-2xl rounded-xl '>
                <div class="flex flex-col w-full">
                    <div class="flex p-5 border-b">
                        <img id="musicCoverPhoto" class='object-cover w-20 h-20' alt='User avatar' src="">
                        <div class="flex flex-col w-full px-2">

                            {{-- Status --}}
                            <span id="musicStatus" class="text-xs font-medium text-gray-700 uppercase dark:text-white ">
                                Paused
                            </span>

                            {{-- Title --}}
                            <span id="musicTitle" class="pt-1 text-sm font-semibold text-green-500 capitalize">
                                I think I need a sunrise, I'm tired of the sunset
                            </span>

                            {{-- Author --}}
                            <span id="musicAuthor" class="text-xs font-medium text-gray-500 dark:text-gray-400 ">
                                -"Boston," Augustana
                            </span>

                        </div>
                    </div>


                    <div class="flex flex-col-reverse items-center p-5 sm:flex-row">
                        <div class="flex items-center">
                            <div class="flex p-2 mt-5 space-x-3 sm:mt-0">
                                {{-- Previous --}}
                                <button onclick="previousSongForMusic()"
                                    class="group focus:outline-none hover:scale-125">
                                    <i
                                        class="text-green-400 transition fa-solid fa-backward-step group-hover:text-green-500 "></i>
                                </button>

                                {{-- Play --}}
                                <button onclick="togglePlayPauseForMusic()"
                                    class=" group rounded-full focus:outline-none w-10 h-10 flex items-center justify-center pl-0.5 ring-1 ring-green-400 hover:ring-green-500 hover:ring-2">
                                    <i id="playPauseIconForMusic"
                                        class="text-green-400 fa-solid fa-play group-hover:text-green-500 group-hover:scale-125"></i>
                                </button>

                                {{-- Next --}}
                                <button onclick="nextSongForMusic()" class=" group focus:outline-none hover:scale-125">
                                    <i
                                        class="text-green-400 transition fa-solid fa-forward-step group-hover:text-green-500 "></i>
                                </button>
                            </div>
                        </div>

                        <div class="relative w-full ml-2 sm:w-1/2 md:w-7/12 lg:w-4/6">
                            {{-- Music Progress Slider --}}
                            <input id="music-progress-slider" type="range" value="0" class="">
                        </div>

                        <div class="flex justify-end w-full pt-1 sm:w-auto sm:pt-0">
                            {{-- Time --}}
                            <span id="musicCurrentTime"
                                class="pl-2 text-xs font-medium text-gray-700 uppercase dark:text-white">
                            </span>
                        </div>

                    </div>

                    <div class="flex flex-col p-5">
                        {{-- Volume Adjuster --}}
                        <div class="flex items-center justify-between pb-1 mb-2 border-b">
                            <span class="text-base font-semibold text-gray-700 uppercase dark:text-white"> play
                                list</span>
                            <span class="flex items-center space-x-2">
                                <i id="volumeIconForMusic"
                                    class="fa-solid fa-volume-high text-slate-500 dark:text-white"></i>
                                <input type="range" id="musicVolumeControl" min="0" max="1"
                                    step="0.01" value="0.9" onchange="adjustMusicVolume()"
                                    style="accent-color: rgb(74 222 128);">
                                {{-- Label --}}
                                <span id="musicCurrentVolumeTxt"
                                    class="text-xs font-medium text-gray-700 uppercase dark:text-white">
                                    90%
                                </span>
                            </span>

                        </div>

                        {{-- Playlist --}}
                        <div
                            class="flex px-2 py-3 transition-all duration-100 ease-in border-b cursor-pointer dark:border dark:border-gray-700 hover:shadow-sm hover:bg-gray-100 hover:rounded-xl dark:hover:bg-gray-900">
                            {{-- Avatar --}}
                            <img class='object-cover w-10 h-10 rounded-lg' alt='User avatar'
                                src='https://images.unsplash.com/photo-1477118476589-bff2c5c4cfbb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=200&q=200'>
                            <div class="flex flex-col w-full px-2">

                                <span class="pt-1 text-sm font-semibold text-green-500 capitalize">
                                    I think I need a sunrise, I'm tired of the sunset
                                </span>
                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 ">
                                    -"Boston," Augustana
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <script>
            let passedPlaylist = @json($songs_filepath);
            let passedSongsTitle = @json($songs_title);
            let passedSongsArtist = @json($songs_artist);
            let passedSongsCover = @json($songs_cover_photo);

            // Parse the JSON string into a JavaScript array
            let playlistArray = JSON.parse(passedPlaylist);
            let songsTitleArray = JSON.parse(passedSongsTitle);
            let songsArtistArray = JSON.parse(passedSongsArtist);
            let songsCoverArray = JSON.parse(passedSongsCover);

            let currentMusicIndex = 0;
            let totalMusicCount = playlistArray.length;

            let musicAudio = new Audio('/audio/' + playlistArray[currentMusicIndex]); // Adjust the Web URL as necessary
            let playPauseIconForMusic = document.getElementById('playPauseIconForMusic');
            let musicProgressSlider = document.getElementById('music-progress-slider');
            let musicCurrentTime = document.getElementById('musicCurrentTime');
            let musicIntervalID;
            let musicStatus = document.getElementById('musicStatus');



            // Rendering Music Info
            let musicTitle = document.getElementById('musicTitle');
            let musicAuthor = document.getElementById('musicAuthor');
            let musicCover = document.getElementById('musicCoverPhoto');

            function renderMusicInfo() {
                musicTitle.innerText = songsTitleArray[currentMusicIndex];
                musicAuthor.innerText = songsArtistArray[currentMusicIndex];

                let currentCover = songsCoverArray[currentMusicIndex];
                let imageUrl = "/storage/" + currentCover;
                musicCover.src = imageUrl;
            }

            renderMusicInfo();





            // Music Volume -------------------------------------------------------------
            let musicVolumeControl = document.getElementById("musicVolumeControl");
            let musicCurrentVolumeTxt = document.getElementById("musicCurrentVolumeTxt");
            let volumeIconForMusic = document.getElementById("volumeIconForMusic");


            function adjustMusicVolume() {
                musicAudio.volume = musicVolumeControl.value;
                musicCurrentVolumeTxt.innerText = `${Math.floor(musicAudio.volume * 100)}%`;

                //Icon Change for Volume
                if (musicAudio.volume == 0) {
                    volumeIconForMusic.classList.remove('fa-volume-high');
                    volumeIconForMusic.classList.add('fa-volume-xmark');
                } else {
                    volumeIconForMusic.classList.remove('fa-volume-xmark');
                    volumeIconForMusic.classList.add('fa-volume-high');
                }
            }

            // Music On Start ------------------------------------------------------------
            musicAudio.onloadedmetadata = function() {
                musicProgressSlider.max = musicAudio.duration;
                musicProgressSlider.value = musicAudio.currentTime;
            }


            function togglePlayPauseForMusic() {
                // Play Icon is showing, Music is Playing
                if (playPauseIconForMusic.classList.contains('fa-play')) {
                    playPauseIconForMusic.classList.remove('fa-play');
                    playPauseIconForMusic.classList.add('fa-pause');
                    musicAudio.play();
                    musicIntervalID = setInterval(updateMusicIntervalDetails, 1000);
                    musicStatus.innerText = 'Now Playing';

                } else {
                    // Pause Icon is showing, Music is Playing 
                    playPauseIconForMusic.classList.remove('fa-pause');
                    playPauseIconForMusic.classList.add('fa-play');
                    musicAudio.pause();
                    clearInterval(musicIntervalID);
                    musicStatus.innerText = 'Paused';

                }
            }


            function updateMusicIntervalDetails() {
                if (musicAudio.play()) {
                    musicProgressSlider.value = musicAudio.currentTime;
                    musicCurrentTime.innerText =
                        `${formatMusicTime(musicAudio.currentTime)} / ${formatMusicTime(musicAudio.duration)}`;
                }
            }


            musicProgressSlider.onchange = function() {
                musicAudio.currentTime = musicProgressSlider.value;
                playPauseIconForMusic.classList.remove('fa-play');
                playPauseIconForMusic.classList.add('fa-pause');
                clearInterval(musicIntervalID);
                musicIntervalID = setInterval(updateMusicIntervalDetails, 1000);
            }


            // Function to format time
            function formatMusicTime(seconds) {
                let minutes = Math.floor(seconds / 60);
                let remainingSeconds = Math.floor(seconds % 60);
                return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
            }


            // Music Play List -------------------------------------------------------------
            function previousSongForMusic() {
                ///
            }

            function nextSongForMusic() {
                ///
            }
        </script>
    </div>


</div>
