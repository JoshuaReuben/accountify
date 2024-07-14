<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        {{-- <livewire:layout.topbar-navigation-for-app-layout /> --}}

        {{-- START OF TOP NAVIGATION --}}

        <nav x-data="{ openHamburger: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
            <!-- Primary Navigation Menu -->
            <div class="w-full px-4 mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex items-center shrink-0">
                            <a href="{{ route('dashboard') }}">
                                <x-application-logo
                                    class="block w-auto h-[30px]  md:h-[50px] text-gray-800 fill-current dark:text-gray-200" />
                            </a>
                        </div>



                        <!-- DESKTOP VIEW - Navigation Links -->
                        <x-layouts.user-responsive-navlinks :isDesktopView="true" />


                    </div>



                    {{-- Top Bar - Icons --}}
                    <div class="flex items-center">

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
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
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

                        <!-- HIDE PROFILE ICON ON SMALL VIEW -->
                        <div class="hidden sm:flex sm:items-center">
                            <!-- PROFILE DROPDOWN -->
                            <livewire:blocks.profile-icon />
                        </div>

                        <!-- Hamburger -->
                        <div class="flex items-center -me-2 sm:hidden">
                            <button @click="openHamburger = ! openHamburger"
                                class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{ 'hidden': openHamburger, 'inline-flex': !openHamburger }"
                                        class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{ 'hidden': !openHamburger, 'inline-flex': openHamburger }"
                                        class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                    </div>




                </div>
            </div>

            <!-- MOBILE VIEW - Responsive Navigation Menu -->
            <div :class="{ 'block': openHamburger, 'hidden': !openHamburger }" class="hidden sm:hidden">
                <x-layouts.user-responsive-navlinks :isDesktopView="false" />


                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                    <div class="px-4">
                        <div class="text-base font-medium text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name ?? auth('admin')->user()->name]) }}"
                            x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                        <div class="text-sm font-medium text-gray-500">
                            {{ auth()->user()->email ?? auth('admin')->user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('user.profile')">
                            {{ __('My Profile') }}
                        </x-responsive-nav-link>

                        <x-responsive-nav-link :href="route('user.account')">
                            {{ __('My Account') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-responsive-nav-link>
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        {{-- END OF TOP NAVIGATION --}}

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    {{-- FlowBite CDN Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

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
    </script>

</body>


</html>
