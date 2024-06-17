
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
                <div class="flex items-center justify-start">

                    <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
                        aria-controls="drawer-navigation"
                        class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg aria-hidden="true" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Toggle sidebar</span>
                    </button>
                    <a href="#" class="flex items-center justify-between mr-4">
                        <img src="https://flowbite.s3.amazonaws.com/logo.svg" class="h-8 mr-3" alt="Accountify Logo" />
                        <span
                            class="self-center font-semibold sm:text-lg md:text-2xl whitespace-nowrap dark:text-white">Accountify</span>
                    </a>
                </div>


                <div class="flex items-center lg:order-2">

                    {{-- Timer --}}
                    <x-buttons.timer-button />


                    <!-- THEME TOGGLER -->
                    <div
                        class="p-2 pt-4 mr-0 text-gray-500 rounded-lg md:mr-1 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                        <x-buttons.theme-toggler />
                    </div>

                    {{-- Music Icon --}}
                    <div>
                        <div
                            class="p-2 pt-4 mr-0 text-center text-gray-500 rounded-lg md:mr-1 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                            <button type="button" data-drawer-target="drawer-music-playlist"
                                data-drawer-show="drawer-music-playlist" data-drawer-placement="right"
                                aria-controls="drawer-music-playlist">
                                <i class="w-5 h-5 fa-solid fa-music md:h-6 md:w-6"></i>
                            </button>
                        </div>

                        <!-- Music Playlist drawer component -->
                        <div id="drawer-music-playlist"
                            class="fixed top-20 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-96 dark:bg-gray-800"
                            tabindex="-1" aria-labelledby="drawer-right-label">

                            <h5 id="drawer-right-label"
                                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>Playlist
                            </h5>

                            <button type="button" data-drawer-hide="drawer-music-playlist"
                                aria-controls="drawer-music-playlist"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close menu</span>
                            </button>

                            <div class="mt-auto">
                                <livewire:blocks.music-playlist />
                            </div>
                        </div>

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
        <x-layouts.admin-sidebar-nav />
        <!-- End of Sidebar -->

        <main class="h-auto p-4 pt-20 mt-6 md:ml-64">
            {{-- CONTENT SECTION TEMPORARY --}}
            <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
                {{-- NAVBAR --}}

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

</html>
