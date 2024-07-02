<?php

use Livewire\Volt\Component;
use App\Models\Music;
use Livewire\Attributes\On;

new class extends Component {
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
    }
}; ?>


<div>


    {{-- MUSIC PLAYER ----------------------------------------------------------------------------------------------------------- --}}
    <div>

        {{-- Music Layout Design --}}
        <div class="w-full ">
            <div
                class='flex w-full mx-auto overflow-hidden bg-gray-100 shadow-md dark:bg-gray-800 dark:ring-1 dark:ring-gray-600 drop-shadow-2xl rounded-xl '>

                {{-- Show if Music Count is Greater than 0 --}}
                @if (count($this->songs) > 0)
                    <div class="flex flex-col w-full">
                        <div class="flex p-5 border-b">
                            <img id="musicCoverPhoto" class='object-cover w-20 h-20' alt='User avatar' src="">
                            <div class="flex flex-col w-full px-2">

                                {{-- Status --}}
                                <span id="musicStatus"
                                    class="text-xs font-medium text-gray-700 uppercase dark:text-white ">
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


                        <div class="flex flex-col-reverse items-center p-5">
                            <div class="flex items-center">
                                <div class="flex p-2 mt-2 space-x-3">
                                    {{-- Previous --}}
                                    <button onclick="previousSongForMusic()"
                                        class="group focus:outline-none hover:scale-125">
                                        <i
                                            class="text-green-400 transition fa-solid fa-backward-step group-hover:text-green-500 text-2xl "></i>
                                    </button>

                                    {{-- Play --}}
                                    <button onclick="togglePlayPauseForMusic()"
                                        class=" group rounded-full focus:outline-none w-14 h-14 flex items-center justify-center pl-0.5 ring-1 ring-green-400 hover:ring-green-500 hover:ring-2">
                                        <i id="playPauseIconForMusic"
                                            class="text-green-400 fa-solid fa-play group-hover:text-green-500 group-hover:scale-125 text-2xl"></i>
                                    </button>

                                    {{-- Next --}}
                                    <button onclick="nextSongForMusic()"
                                        class=" group focus:outline-none hover:scale-125">
                                        <i
                                            class="text-green-400 transition fa-solid fa-forward-step group-hover:text-green-500 text-2xl "></i>
                                    </button>
                                </div>
                            </div>

                            <div class="relative w-full ml-2">
                                {{-- Music Progress Slider --}}
                                <input id="music-progress-slider" type="range" value="0" class="">
                            </div>

                            <div class="flex justify-end w-full pt-1 sm:pt-0">
                                {{-- Time --}}
                                <span id="musicCurrentTime"
                                    class="pl-2 text-xs font-medium text-gray-700 uppercase dark:text-white">
                                    00:00 / --:--
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
                                        step="0.01" value="0.9" style="accent-color: rgb(74 222 128);">
                                    {{-- Label --}}
                                    <span id="musicCurrentVolumeTxt"
                                        class="text-xs font-medium text-gray-700 uppercase dark:text-white">
                                        90%
                                    </span>
                                </span>

                            </div>

                            {{-- Playlist --}}
                            <div class="flex flex-col h-[40vh] overflow-y-auto">
                                @foreach ($songs as $song)
                                    <div
                                        class="song-playlist flex px-2 py-3 transition-all duration-100 ease-in border-b cursor-pointer dark:border dark:border-gray-700 hover:shadow-sm hover:bg-gray-100 hover:rounded-xl dark:hover:bg-gray-900">
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



        <script>
            // Logs:
            // remove json encode so you don't need to json parse it at client side, 
            // convert the whole js process into callable function
            // try passing new values as a parameter to the callable function after a dispatched event


            // Variables

            let passedPlaylist = @json($songs_filepath);
            let passedSongsTitle = @json($songs_title);
            let passedSongsArtist = @json($songs_artist);
            let passedSongsCover = @json($songs_cover_photo);


            let playlistArray;
            let songsTitleArray;
            let songsArtistArray;
            let songsCoverArray;
            let totalMusicCount;



            let playPauseIconForMusic = document.getElementById('playPauseIconForMusic');
            let musicProgressSlider = document.getElementById('music-progress-slider');
            let musicCurrentTime = document.getElementById('musicCurrentTime');
            let musicStatus = document.getElementById('musicStatus');

            let musicAudio = new Audio();
            let currentMusicIndex;
            let musicIntervalID;


            // Rendering Music Info
            let musicTitle = document.getElementById('musicTitle');
            let musicAuthor = document.getElementById('musicAuthor');
            let musicCover = document.getElementById('musicCoverPhoto');

            // Music Volume -------------------------------------------------------------
            let musicVolumeControl = document.getElementById("musicVolumeControl");
            let musicCurrentVolumeTxt = document.getElementById("musicCurrentVolumeTxt");
            let volumeIconForMusic = document.getElementById("volumeIconForMusic");


            function startMusicPlayer(paths, titles, artists, covers) {
                playlistArray = paths;
                songsTitleArray = titles;
                songsArtistArray = artists;
                songsCoverArray = covers;

                currentMusicIndex = 0;
                totalMusicCount = playlistArray.length;

                // Start the music player
                musicAudio = new Audio('/audio/' + playlistArray[currentMusicIndex]); // Adjust the Web URL as necessary

                // Music On Start ------------------------------------------------------------
                musicAudio.onloadedmetadata = function() {
                    musicProgressSlider.max = musicAudio.duration;
                    musicProgressSlider.value = musicAudio.currentTime;
                }

                renderMusicInfo();
            }


            // Start the music player only if the variables passed are not null

            if (passedPlaylist.length != 0) {
                startMusicPlayer(passedPlaylist, passedSongsTitle, passedSongsArtist, passedSongsCover);
            } else {
                console.log('Side Note: No songs added yet on the music playlist');
            }

            // startMusicPlayer(passedPlaylist, passedSongsTitle, passedSongsArtist, passedSongsCover);

            /////////////////////////////////////////////////////////////////////////////////

            // When the song ends, increment the currentMusicIndex then play
            musicAudio.onended = function() {
                nextSongForMusic();
            }

            // Initialize the function for Progress Slider and Music Volume if there is a song
            if (passedPlaylist.length != 0) {
                musicProgressSlider.onchange = function() {
                    musicAudio.currentTime = musicProgressSlider.value;
                    playPauseIconForMusic.classList.remove('fa-play');
                    playPauseIconForMusic.classList.add('fa-pause');
                    clearInterval(musicIntervalID);
                    musicIntervalID = setInterval(updateMusicIntervalDetails, 1000);
                }

                musicVolumeControl.onchange = function() {
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
            }


            // When clicking a new song to play, update the play-pause icon
            musicAudio.onplaying = function() {
                playPauseIconForMusic.classList.remove('fa-play');
                playPauseIconForMusic.classList.add('fa-pause');
                clearInterval(musicIntervalID);
                musicIntervalID = setInterval(updateMusicIntervalDetails, 1000);
                musicStatus.innerText = 'Now Playing';
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

                    //if audio metadata is loaded
                    if (musicAudio.duration) {
                        musicCurrentTime.innerText =
                            `${formatMusicTime(musicAudio.currentTime)} / ${formatMusicTime(musicAudio.duration)}`;
                    } else {
                        musicCurrentTime.innerText = '00:00 / --:--';
                    }


                }
            }


            // Rendering Music Info
            function renderMusicInfo() {
                musicTitle.innerText = songsTitleArray[currentMusicIndex];
                musicAuthor.innerText = songsArtistArray[currentMusicIndex];

                let currentCover = songsCoverArray[currentMusicIndex];
                let imageUrl = "/storage/" + currentCover;
                musicCover.src = imageUrl;
            }



            // Function to format time
            function formatMusicTime(seconds) {
                let minutes = Math.floor(seconds / 60);
                let remainingSeconds = Math.floor(seconds % 60);
                return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
            }





            // Playlist via click
            let songPlaylist = document.querySelectorAll('.song-playlist');

            for (let i = 0; i < songPlaylist.length; i++) {
                songPlaylist[i].addEventListener('click', function() {
                    currentMusicIndex = Math.abs(i);
                    musicAudio.src = '/audio/' + playlistArray[currentMusicIndex];
                    musicAudio.play();
                    renderMusicInfo();
                });
            }

            // Music Play List -------------------------------------------------------------
            function previousSongForMusic() {
                currentMusicIndex = currentMusicIndex % totalMusicCount;
                currentMusicIndex = ((currentMusicIndex - 1) + totalMusicCount) % totalMusicCount;

                console.log(currentMusicIndex);
                musicAudio.src = '/audio/' + playlistArray[currentMusicIndex];
                renderMusicInfo();
            }

            function nextSongForMusic() {
                currentMusicIndex = (currentMusicIndex + 1) % totalMusicCount;
                currentMusicIndex = Math.abs(currentMusicIndex);

                musicAudio.src = '/audio/' + playlistArray[currentMusicIndex];
                renderMusicInfo();
            }
        </script>

    </div>


</div>
