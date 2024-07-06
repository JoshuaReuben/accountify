<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Accountify') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/fa835006d0.js" crossorigin="anonymous"></script>

    {{-- FlowBite CDN --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-gray-800">

    {{-- ADMIN LAYOUT WITH 2 SIDE BAR --}}
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <nav
            class="bg-white border-b border-gray-200 px-2 md:px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
            <div class="flex flex-wrap items-center justify-between">
                <div x-data= "{ open : true }" class="flex items-center justify-start">

                    {{-- Open Sidebar --}}
                    <button x-show="open == true" @click="$dispatch('open-admin-sidebar'); open = false"
                        class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        {{-- Toggle Sidebar Menu --}}
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    {{-- Close Sidebar --}}
                    <button x-show="open == false" x-on:close-admin-sidebar.window="open = true"
                        @click="$dispatch('close-admin-sidebar'); open = true"
                        class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer  hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg class=" w-6 h-6 " fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <x-application-logo />
                </div>


                {{-- Top Bar --}}
                <div class="flex items-center lg:order-2">

                    {{-- Timer --}}
                    <x-buttons.timer-button />


                    <!-- THEME TOGGLER -->
                    <div
                        class="p-2 pt-4 mr-0 ml-2 text-gray-500 rounded-lg md:mr-1 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                        <x-buttons.theme-toggler />
                    </div>


                    {{--  Music Playlist --}}
                    <div>
                        <div
                            class="p-2 pt-4 mr-0 text-center text-gray-500 rounded-lg md:mr-1 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                            <button x-data @click="$dispatch('open-music-player')" type="button">
                                <i class="w-5 h-5 fa-solid fa-music md:h-6 md:w-6"></i>
                            </button>
                        </div>

                        <section x-data="musicSidebar()" x-cloak x-on:open-music-player.window="open = true"
                            @keydown.escape.window="open = false" x-init="init()">

                            {{-- Overlay --}}
                            <div x-show.transition.opacity.duration.500="open" @click="open = false"
                                class="fixed z-50 inset-0 bg-black bg-opacity-40"></div>

                            {{-- Side Bar --}}
                            <div class="fixed z-50 transition duration-300 right-0 top-0 transform w-full max-w-sm h-screen bg-gray-100 overflow-hidden dark:bg-gray-800"
                                :class="{ 'translate-x-full': open == false }">

                                <div class="flex items-center mt-10 w-full">

                                    <h5
                                        class="inline-flex mt-4 items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400 uppercase ml-4">
                                        <svg class="w-4 h-4 me-2.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>Music Playlist
                                    </h5>

                                    <button @click="open = false"
                                        class="fixed top-10 right-2 mr-4 mt-2 z-50 text-gray-400  hover:text-gray-900  dark:hover:text-white bg-transparent">
                                        {{-- Close Button --}}
                                        <i class="fa-solid fa-xmark text-3xl"></i>
                                    </button>
                                </div>



                                <div class="pt-2 px-6 absolute h-full w-full overflow-y-auto">
                                    {{-- Side Bar Content --}}
                                    <div class="mt-auto">
                                        <livewire:blocks.music-playlist />
                                    </div>
                                </div>
                            </div>

                        </section>

                    </div>


                    <!-- NOTIFICATIONS -->
                    <div
                        class="p-2 pt-4 mr-0 text-gray-500 rounded-lg md:mr-1 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                        <x-buttons.notifications />
                    </div>

                    <!-- PROFILE DROPDOWN -->
                    <livewire:blocks.profile-icon />
                </div>
            </div>
        </nav>

        {{-- START ADMIN SIDE BAR --}}
        <aside x-data="adminSidebar()" x-cloak x-on:open-admin-sidebar.window="open = true"
            x-on:close-admin-sidebar.window="open = false" x-init="init()"
            x-bind:class="open ? 'translate-x-0' : '-translate-x-full'"
            class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 pt-14  dark:bg-gray-800 dark:border-gray-700">

            <x-layouts.admin-sidebar-nav />
        </aside>

        {{-- Overlay --}}
        <div x-data="{ toggleOverlay: false }" x-cloak x-on:open-admin-sidebar.window="toggleOverlay = true"
            x-on:close-admin-sidebar.window="toggleOverlay = false"
            x-show.transition.opacity.duration.500="toggleOverlay == true"
            @click="$dispatch('close-admin-sidebar'), toggleOverlay = false"
            class="fixed z-30 inset-0 bg-black bg-opacity-40"></div>

        {{-- END OF ADMIN SIDE BAR --}}


        {{-- ################################################################################################### --}}
        <main class="fixed w-full h-auto pt-20">

            <div x-data="{ isSidebarOpen: true }" class="flex flex-row min-h-screen bg-gray-100 dark:bg-gray-900">
                {{-- START RESOURCE NAVBAR --}}
                <div class="h-screen bg-white border-r border-gray-200 w-96 dark:bg-gray-800 dark:border-gray-700"
                    :class="{ ' hidden': !isSidebarOpen, ' block': isSidebarOpen }">

                    <div class="px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800"
                        style="height: calc(100% - 80px);">

                        {{-- START SIDEBAR CONTENTS --}}
                        <div>
                            {{ $sidebarContent }}
                        </div>

                        {{-- END SIDEBAR CONTENTS --}}

                    </div>
                </div>
                {{-- END RESOURCE NAVBAR --}}


                <div class="w-full">
                    {{-- START PAGE HEADING --}}
                    @if (isset($header))
                        <header class="bg-white shadow dark:bg-gray-800">
                            <div class="flex items-center px-4 py-6 mx-auto ">
                                <div>
                                    <button @click="isSidebarOpen = !isSidebarOpen">
                                        <i x-show="!isSidebarOpen"
                                            class="mx-3 text-2xl cursor-pointer fa-solid fa-bars dark:text-white"></i>
                                        <i x-show="isSidebarOpen"
                                            class="mx-3 text-2xl cursor-pointer fa-solid fa-bars-staggered dark:text-white"></i>
                                    </button>
                                </div>
                                <div class="w-full ">
                                    {{ $header }}
                                </div>
                            </div>
                        </header>
                    @endif
                    {{-- END PAGE HEADING --}}

                    {{-- START PAGE CONTENT --}}
                    <div class="overflow-y-auto " style="height: calc(100vh - 160px);">
                        {{ $slot }}
                    </div>
                    {{-- END PAGE CONTENT --}}
                </div>
            </div>

        </main>
    </div>
    {{-- END OF ADMIN LAYOUT WITH 2 SIDE BAR --}}


    {{-- FlowBite CDN Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>
{{-- AJAX --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Music Player - toggle overlay
    function musicSidebar() {
        return {
            open: false,
            init() {
                this.$watch('open', value => {
                    this.toggleOverlay()
                })

            },
            toggleOverlay() {
                document.body.classList[this.open ? 'add' : 'remove']('h-screen', 'overflow-hidden');
            }
        }
    }


    function adminSidebar() {
        return {
            open: false,
            init() {
                this.$watch('open', value => {
                    this.toggleOverlay()
                })

            },
            toggleOverlay() {
                document.body.classList[this.open ? 'add' : 'remove']('h-screen', 'overflow-hidden');
            }
        }
    }
</script>


</html>
