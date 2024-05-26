<div>
    <!-- This is an example component -->
    <div class="w-full ">
        <div
            class='flex w-full bg-gray-100 dark:bg-gray-800 dark:ring-1 dark:ring-gray-600  shadow-md drop-shadow-2xl rounded-xl overflow-hidden mx-auto '>
            <div class="flex flex-col w-full">
                <div class="flex p-5 border-b">
                    <img class='w-20 h-20 object-cover' alt='User avatar'
                        src='https://images.unsplash.com/photo-1477118476589-bff2c5c4cfbb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=200&q=200'>
                    <div class="flex flex-col px-2 w-full">

                        {{-- Status --}}
                        <span class="text-xs text-gray-700 dark:text-white uppercase font-medium ">
                            now playing
                        </span>

                        {{-- Title --}}
                        <span class="text-sm text-green-500 capitalize font-semibold pt-1">
                            I think I need a sunrise, I'm tired of the sunset
                        </span>

                        {{-- Author --}}
                        <span class="text-xs text-gray-500 font-medium  dark:text-gray-400 ">
                            -"Boston," Augustana
                        </span>

                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row items-center p-5">
                    <div class="flex items-center">
                        <div class="  flex space-x-3 p-2 mt-5 sm:mt-0">
                            {{-- Previous --}}
                            <button class="group focus:outline-none  hover:scale-125">
                                <i
                                    class="transition fa-solid fa-backward-step text-green-400 group-hover:text-green-500 "></i>
                            </button>

                            {{-- Play --}}
                            <button onclick="togglePlayPauseForMusic()"
                                class=" group rounded-full focus:outline-none w-10 h-10 flex items-center justify-center pl-0.5 ring-1 ring-green-400 hover:ring-green-500 hover:ring-2">
                                <i id="playPauseIconForMusic"
                                    class="fa-solid fa-play text-green-400 group-hover:text-green-500 group-hover:scale-125"></i>
                            </button>

                            {{-- Next --}}
                            <button class="  group focus:outline-none hover:scale-125">
                                <i
                                    class="transition fa-solid fa-forward-step text-green-400 group-hover:text-green-500 "></i>
                            </button>
                        </div>
                    </div>

                    <div class="relative w-full sm:w-1/2 md:w-7/12 lg:w-4/6 ml-2">
                        <input id="music-progress-slider" type="range" value="0" class="">
                    </div>

                    <div class="flex justify-end w-full sm:w-auto pt-1 sm:pt-0">
                        {{-- Time --}}
                        <span class="text-xs text-gray-700 uppercase font-medium pl-2 dark:text-white">
                            02:00/04:00
                        </span>
                    </div>

                </div>

                <div class="flex flex-col p-5">
                    {{-- Volume Adjuster --}}
                    <div class="border-b pb-1 flex justify-between items-center mb-2">
                        <span class=" text-base font-semibold uppercase text-gray-700 dark:text-white"> play list</span>
                        <span class="flex items-center space-x-2">
                            <i class="fa-solid fa-volume-high text-slate-500 dark:text-white"></i>
                            <i class="fa-solid fa-volume-xmark text-slate-500 dark:text-white"></i>
                            <input type="range" name="" id="" style="accent-color: rgb(74 222 128);">
                        </span>
                    </div>

                    {{-- Playlist --}}
                    <div
                        class=" transition-all ease-in duration-100 flex border-b dark:border dark:border-gray-700 py-3 cursor-pointer hover:shadow-sm hover:bg-gray-100 hover:rounded-xl dark:hover:bg-gray-900 px-2 ">
                        {{-- Avatar --}}
                        <img class='w-10 h-10 object-cover rounded-lg' alt='User avatar'
                            src='https://images.unsplash.com/photo-1477118476589-bff2c5c4cfbb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=200&q=200'>
                        <div class="flex flex-col px-2 w-full">

                            <span class="text-sm text-green-500 capitalize font-semibold pt-1">
                                I think I need a sunrise, I'm tired of the sunset
                            </span>
                            <span class="text-xs text-gray-500 font-medium dark:text-gray-400  ">
                                -"Boston," Augustana
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
