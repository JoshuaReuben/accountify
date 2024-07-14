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

<body class="font-sans antialiased">

    {{-- ADMIN SIDE BAR --}}
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <nav
            class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
            <div class="flex flex-wrap items-center justify-between">
                <div x-data= "{ open : true }" class="flex items-center justify-start">

                    {{-- Open Sidebar --}}
                    <button x-show="open == true" @click="$dispatch('open-admin-sidebar'); open = false"
                        class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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
                        class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg class="w-6 h-6 " fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <a href="#" class="flex items-center justify-between mr-4">
                        <img src="https://flowbite.s3.amazonaws.com/logo.svg" class="h-8 mr-3" alt="Accountify Logo" />
                        <span
                            class="self-center font-semibold sm:text-lg md:text-2xl whitespace-nowrap dark:text-white">Accountify</span>
                    </a>
                </div>


                {{-- Top Bar --}}
                <div class="flex items-center lg:order-2">

                    {{-- Timer --}}
                    <x-buttons.timer-button />


                    <!-- THEME TOGGLER -->
                    <div
                        class="p-2 pt-4 ml-2 mr-0 text-gray-500 rounded-lg md:mr-1 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
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
                                class="fixed inset-0 z-50 bg-black bg-opacity-40"></div>

                            {{-- Side Bar --}}
                            <div class="fixed top-0 right-0 z-50 w-full h-screen max-w-sm overflow-hidden transition duration-300 transform bg-gray-100 dark:bg-gray-800"
                                :class="{ 'translate-x-full': open == false }">

                                <div class="flex items-center w-full mt-10">

                                    <h5
                                        class="inline-flex items-center mt-4 mb-4 ml-4 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
                                        <svg class="w-4 h-4 me-2.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>Music Playlist
                                    </h5>

                                    <button @click="open = false"
                                        class="fixed z-50 mt-2 mr-4 text-gray-400 bg-transparent top-10 right-2 hover:text-gray-900 dark:hover:text-white">
                                        {{-- Close Button --}}
                                        <i class="text-3xl fa-solid fa-xmark"></i>
                                    </button>
                                </div>



                                <div class="absolute w-full h-full px-6 pt-2 overflow-y-auto">
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

        <!-- Start of Sidebar -->
        <aside x-data="adminSidebar()" x-cloak x-on:open-admin-sidebar.window="open = true"
            x-on:close-admin-sidebar.window="open = false" x-init="init()"
            x-bind:class="open ? 'translate-x-0' : '-translate-x-full'"
            class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 pt-14 dark:bg-gray-800 dark:border-gray-700">

            <x-layouts.admin-sidebar-nav />
        </aside>

        {{-- Overlay --}}
        <div x-data="{ toggleOverlay: false }" x-cloak x-on:open-admin-sidebar.window="toggleOverlay = true"
            x-on:close-admin-sidebar.window="toggleOverlay = false"
            x-show.transition.opacity.duration.500="toggleOverlay == true"
            @click="$dispatch('close-admin-sidebar'), toggleOverlay = false"
            class="fixed inset-0 z-30 bg-black bg-opacity-40"></div>

        <!-- End of Sidebar -->

        <main class="h-auto p-4 pt-20 mt-6 md:ml-64">
            {{-- CONTENT SECTION --}}
            <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white rounded-lg shadow dark:bg-gray-800">
                        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </main>
    </div>
    {{-- END OF ADMIN SIDE BAR --}}


    {{-- FlowBite CDN Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>
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
