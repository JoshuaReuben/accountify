<div>
    <h1 class="mb-4 text-xl font-bold uppercase">PLAYLIST OF SONGS</h1>
    <div class="relative shadow-md sm:rounded-lg">
        <div class="flex flex-row flex-wrap items-center justify-end pb-4 space-y-4 bg-white dark:bg-gray-800">


            <div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live.delay="music_search" id="table-search-musics"
                        class="block w-48 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 md:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for musics">
                </div>
            </div>





        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
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
                        <tr wire:key="song-{{ $song->id }}"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4">
                                <img class="w-10 h-10 rounded-lg" src="/storage/{{ $song->song_cover_photo }}"
                                    alt="">
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

                                {{-- Edit - MODAL PART BUTTON --}}
                                <button onclick="editMusicRow({{ $song->id }})"
                                    class="font-medium text-blue-600 dark:text-blue-500">
                                    <i class="mx-1 fa-solid fa-pen-to-square text-md lg:text-lg "></i>
                                </button>

                                {{-- Delete --}}
                                <button wire:confirm="Are you sure you want to delete this song?"
                                    wire:click="deleteSong({{ $song->id }})"
                                    class="font-medium text-red-600 dark:text-red-500">
                                    <i class="mx-1 fa-solid fa-trash-can text-md lg:text-lg "></i>
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td colspan="6" class="px-6 py-4">
                                <p class="text-sm italic text-center lg:text-md">No songs found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    <script>
        function deleteMusicRow(el, musicID) {
            var confirmation = confirm("Are you sure you want to delete this song?");
            if (confirmation) {
                el.closest('tr').classList.add('hidden');
                window.location.href = 'delete/' + musicID;
            }
        }

        function editMusicRow(musicID) {
            window.location.href = 'edit/' + musicID;
        }
    </script>

</div>
