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
    <!-- component -->
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
        <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-gray-800">
                Loading.....
            </div>

            <!-- Sidebar -->
            <div class="flex flex-shrink-0 transition-all">
                {{-- Backdrop when sidebar is open at mobile view --}}
                <div x-show="isSidebarOpen" @click="isSidebarOpen = false"
                    class="fixed inset-0 z-10 bg-black bg-opacity-50 lg:hidden"></div>
                <div x-show="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 "></div>

                <!-- Mobile bottom bar -->
                <nav aria-label="Options"
                    class="fixed inset-x-0 bottom-0 flex flex-row-reverse items-center justify-between px-4 py-2 bg-white border-t border-gray-100 sm:hidden shadow-t rounded-t-3xl">
                    <!-- Menu button -->
                    <button
                        @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                        class="p-2 transition-colors rounded-lg shadow-md hover:bg-gray-800 hover:text-white focus:outline-none focus:ring focus:ring-gray-600 focus:ring-offset-white focus:ring-offset-2"
                        :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-gray-600' :
                        'text-gray-500 bg-white'">
                        <span class="sr-only">Toggle sidebar</span>
                        <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>

                    <!-- Logo -->
                    <a href="#">
                        <x-app-logo-image />
                    </a>

                    <!-- User avatar button -->
                    <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
                        <button @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})"
                            class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-gray-600 focus:ring-offset-white focus:ring-offset-2">
                            {{-- Profile Image --}}
                            <img class="w-8 h-8 rounded-lg shadow-md"
                                src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                alt="Ahmed Kamel" />
                            <span class="sr-only">User menu</span>
                        </button>

                        <div x-show="isOpen" @click.away="isOpen = false" @keydown.escape="isOpen = false"
                            x-ref="userMenu" tabindex="-1"
                            class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-label="user menu">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem">Your Profile</a>

                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem">Sign out</a>
                        </div>
                    </div>
                </nav>

                <!-- Left mini bar -->
                <nav aria-label="Options"
                    class="z-50 flex-col items-center flex-shrink-0 hidden w-16 py-4 bg-white border-r-2 border-gray-100 shadow-md sm:flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 py-4">
                        <a href="#">
                            <x-app-logo-image class="w-full mx-auto " />
                        </a>
                    </div>
                    <div class="flex flex-col items-center flex-1 p-2 space-y-4">
                        <!-- Menu button -->
                        <button
                            @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                            class="p-2 transition-colors rounded-lg shadow-md hover:bg-gray-800 hover:text-white focus:outline-none focus:ring focus:ring-gray-600 focus:ring-offset-white focus:ring-offset-2"
                            :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-gray-600' :
                            'text-gray-500 bg-white'">
                            <span class="sr-only">Toggle sidebar</span>
                            <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </button>

                        <!-- Messages button -->
                        <button
                            @click="(isSidebarOpen && currentSidebarTab == 'messagesTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'messagesTab'"
                            class="p-2 transition-colors rounded-lg shadow-md hover:bg-gray-800 hover:text-white focus:outline-none focus:ring focus:ring-gray-600 focus:ring-offset-white focus:ring-offset-2"
                            :class="(isSidebarOpen && currentSidebarTab == 'messagesTab') ? 'text-white bg-gray-600' :
                            'text-gray-500 bg-white'">
                            <span class="sr-only">Toggle message panel</span>
                            <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </button>

                        <!-- Notifications button -->
                        <button
                            @click="(isSidebarOpen && currentSidebarTab == 'notificationsTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'notificationsTab'"
                            class="p-2 transition-colors rounded-lg shadow-md hover:bg-gray-800 hover:text-white focus:outline-none focus:ring focus:ring-gray-600 focus:ring-offset-white focus:ring-offset-2"
                            :class="(isSidebarOpen && currentSidebarTab == 'notificationsTab') ? 'text-white bg-gray-600' :
                            'text-gray-500 bg-white'">
                            <span class="sr-only">Toggle notifications panel</span>
                            <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                    </div>


                </nav>

                <div x-transition:enter="transform transition-transform duration-300"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition-transform duration-300"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    x-show="isSidebarOpen"
                    class="fixed inset-y-0 left-0 z-50 flex-shrink-0 w-64 bg-white border-r-2 border-gray-100 shadow-lg lg:static sm:left-16 sm:w-72 lg:w-64">

                    <nav x-show="currentSidebarTab == 'linksTab'" aria-label="Main"
                        class="flex flex-col h-full bg-white">
                        <!-- Logo -->
                        <div class="flex items-center justify-center flex-shrink-0 py-10">
                            {{-- <a href="#">
                                <x-application-logo />
                            </a> --}}
                            <h2 class="text-xl">Resources</h2>


                        </div>

                        <!-- Links -->
                        <div class="flex-1 px-4 space-y-2 overflow-hidden hover:overflow-auto">
                            <a href="#"
                                class="flex items-center w-full space-x-2 text-white bg-gray-600 rounded-lg">
                                <span aria-hidden="true" class="p-2 bg-gray-700 rounded-lg">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </span>
                                <span>Home</span>
                            </a>
                            <a href="#"
                                class="flex items-center space-x-2 text-gray-600 transition-colors rounded-lg group hover:bg-gray-600 hover:text-white">
                                <span aria-hidden="true"
                                    class="p-2 transition-colors rounded-lg group-hover:bg-gray-700 group-hover:text-white">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <span>Pages</span>
                            </a>
                        </div>


                    </nav>

                    <section x-show="currentSidebarTab == 'messagesTab'" class="px-4 py-6">
                        <h2 class="text-xl">Messages</h2>
                    </section>

                    <section x-show="currentSidebarTab == 'notificationsTab'" class="px-4 py-6">
                        <h2 class="text-xl">Notifications</h2>
                    </section>
                </div>
            </div>



            {{-- Right Side = Navbar + Content --}}
            <div class="flex flex-col flex-1 overflow-y-hidden">
                <div class="h-full">
                    {{-- Top Navbar --}}
                    <div class="relative z-40">
                        <nav
                            class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 sticky top-0">
                            <div class="flex flex-wrap items-center justify-between">

                                <div class="flex items-center justify-start">

                                    <a href="#" class="flex items-center justify-between mr-4">
                                        <img src="https://flowbite.s3.amazonaws.com/logo.svg" class="h-8 mr-3"
                                            alt="Accountify Logo" />
                                        <span
                                            class="self-center font-semibold sm:text-lg md:text-2xl whitespace-nowrap dark:text-white">Accountify</span>
                                    </a>
                                </div>

                                <div class="flex items-center lg:order-2">

                                    {{-- Timer --}}
                                    <div @click="if(window.innerWidth < 768) isSidebarOpen = false">
                                        <x-buttons.timer-button />
                                    </div>


                                    <!-- THEME TOGGLER -->
                                    <div
                                        class="p-2 pt-4 mr-0 text-gray-500 rounded-lg md:mr-1 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                                        <x-buttons.theme-toggler />
                                    </div>

                                    {{-- Music Icon --}}
                                    <div @click="isSidebarOpen = false">
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
                                            class="fixed right-0 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white top-20 w-96 dark:bg-gray-800"
                                            tabindex="-1" aria-labelledby="drawer-right-label">

                                            <h5 id="drawer-right-label"
                                                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                                                <svg class="w-4 h-4 me-2.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                                </svg>Playlist
                                            </h5>

                                            <button type="button" data-drawer-hide="drawer-music-playlist"
                                                aria-controls="drawer-music-playlist"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close menu</span>
                                            </button>

                                            <div class="mt-auto">
                                                <livewire:blocks.music-playlist />
                                            </div>
                                        </div>

                                    </div>

                                    <!-- NOTIFICATIONS -->
                                    <div @click="isSidebarOpen = false"
                                        class="p-2 pt-4 mr-0 text-gray-500 rounded-lg md:mr-1 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                                        <x-buttons.notifications />
                                    </div>

                                </div>

                            </div>
                        </nav>
                    </div>
                    {{-- End of Top Navbar --}}
                    <div class="h-full overflow-y-auto">
                        <!-- Content -->
                        <div
                            class="h-full min-h-screen overflow-y-auto text-gray-900 bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
                            <h1 class="text-5xl font-bold ">In progress</h1>
                            {{ $slot ? 'hehe' : $slot }}
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>


    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <script>
        const setup = () => {
            return {
                isSidebarOpen: false,
                currentSidebarTab: null,
                isSettingsPanelOpen: false,
                isSubHeaderOpen: false,
                watchScreen() {
                    if (window.innerWidth <= 1024) {
                        this.isSidebarOpen = false
                    }
                },
            }
        }
    </script>
    {{-- END OF ADMIN SIDE BAR --}}


    {{-- FlowBite CDN Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>
