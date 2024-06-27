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

    {{-- ADMIN LAYOUT WITH 2 SIDE BAR --}}
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <nav
            class="bg-white border-b border-gray-200 px-4 py-2.5 h-[80px] dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50  ">
            <div class="flex flex-wrap items-center justify-between">

                <div class="flex items-center justify-start">
                    <button id="toggle-button-for-admin-sidebar" data-drawer-target="admin-drawer-navigation"
                        data-drawer-toggle="admin-drawer-navigation" aria-controls="admin-drawer-navigation"
                        class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        {{-- Menu Icon --}}
                        <svg id="menu-icon-for-admin-sidebar" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{-- Close Icon --}}
                        {{-- <svg id="close-icon-for-admin-sidebar" class=" w-6 h-6 hidden" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg> --}}
                        <span class="sr-only">Toggle sidebar</span>
                    </button>
                    <a href="#" class="flex items-center justify-between mr-4">
                        <img src="https://flowbite.s3.amazonaws.com/logo.svg" class="h-8 mr-3" alt="Accountify Logo" />
                        <span
                            class="self-center font-semibold sm:text-lg md:text-2xl whitespace-nowrap dark:text-white">Accountify</span>
                    </a>
                </div>


                {{-- START RIGHT SIDE ICONS --}}
                <div class="flex items-center lg:order-2">

                    {{-- Timer --}}
                    <x-buttons.timer-button />


                    <!-- THEME TOGGLER -->
                    <div
                        class="p-2 pt-4 mr-0 text-gray-500 rounded-lg md:mr-1 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                        <x-buttons.theme-toggler />
                    </div>

                    {{-- Music Icon --}}
                    <div data-drawer-hide="admin-drawer-navigation">
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
                            class="fixed right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white top-20 w-96 dark:bg-gray-800"
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
                {{-- END RIGHT SIDE ICONS --}}


            </div>
        </nav>

        {{-- START ADMIN SIDE BAR --}}
        <div id="admin-sidebar-drawer">
            <aside
                class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 pt-14 dark:bg-gray-800 dark:border-gray-700"
                aria-label="Sidenav" id="admin-drawer-navigation">
                <div class="h-full px-3 py-5 overflow-y-auto bg-white dark:bg-gray-800">

                    <ul class="space-y-2">
                        {{-- SCRATCH --}}
                        <li class="mt-4">
                            <a href="{{ route('admin.scratch') }}"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <x-svgs.pie-chart-icon />
                                <span class="ml-3">scratch</span>
                            </a>
                        </li>

                        {{-- SALES DROPDOWN --}}
                        <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-link-resources" data-collapse-toggle="dropdown-link-resources">

                                {{-- ICON - START --}}
                                <i class="fa-solid fa-graduation-cap"></i>
                                {{-- ICON - END  --}}

                                <span class="flex-1 ml-3 text-left uppercase whitespace-nowrap">RESOURCES</span>

                                {{-- ARROW - START --}}
                                <x-svgs.dropdown-arrow-icon />
                                {{-- ARROW - END --}}

                            </button>
                            <ul id="dropdown-link-resources" class="hidden py-2 space-y-2">
                                <li>
                                    <a href="{{ route('pages.admin.course') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">COURSES</a>
                                </li>
                                <li>
                                    <a href="{{ route('pages.admin.module') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">MODULES</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">LESSONS</a>
                                </li>
                            </ul>
                        </li>


                        {{-- PAYPAL --}}
                        <li class="mt-4">
                            <a href="{{ route('admin.paypal') }}"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                {{-- <x-svgs.pie-chart-icon /> --}}
                                <i class="fa-solid fa-wallet"></i>
                                <span class="ml-3">PAYMENTS</span>
                            </a>
                        </li>


                        {{-- UPLOAD A MUSIC --}}
                        <li class="mt-4 group">
                            <a href="{{ route('pages.admin.music') }}"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                {{-- <i
                            class="text-gray-500 fa-solid fa-cloud-arrow-up dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i> --}}
                                <i class="fa-solid fa-cloud-arrow-up "></i>
                                <span class="ml-3">MUSICS</span>
                            </a>
                        </li>


                        {{-- OVERVIEW --}}
                        <li class="mt-4">
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <x-svgs.pie-chart-icon />
                                <span class="ml-3">OVERVIEW</span>
                            </a>
                        </li>

                        {{-- USERS DROPDOWN --}}
                        <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-users" data-collapse-toggle="dropdown-users">

                                {{-- ICON - START --}}
                                <x-svgs.user-icon />

                                {{-- ICON - END  --}}


                                <span class="flex-1 ml-3 text-left whitespace-nowrap">USERS</span>

                                {{-- ARROW - START --}}
                                <x-svgs.dropdown-arrow-icon />
                                {{-- ARROW - END --}}
                            </button>

                            {{-- CONTENTS DROPDOWN - START --}}
                            <ul id="dropdown-users" class="hidden py-2 space-y-2">
                                <li>
                                    <a href="{{ route('admin.create.patient') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Register
                                        New Patient</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.index.patient') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">View
                                        Patient Records</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Calendar</a>
                                </li>
                            </ul>
                            {{-- CONTENTS DROPDOWN - END --}}
                        </li>


                        {{-- ---------------------------------------------------------- --}}



                        {{-- AUTHENTICATION DROPDOWN --}}

                        <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-authentication"
                                data-collapse-toggle="dropdown-authentication">

                                {{-- ICON - START --}}
                                <x-svgs.padlock-icon />
                                {{-- ICON - END  --}}


                                <span class="flex-1 ml-3 text-left whitespace-nowrap">AUTHENTICATION</span>

                                {{-- ARROW - START --}}
                                <x-svgs.dropdown-arrow-icon />
                                {{-- ARROW - END --}}
                            </button>

                            {{-- CONTENTS DROPDOWN - START --}}
                            <ul id="dropdown-authentication" class="hidden py-2 space-y-2">
                                <li>
                                    <a href="#"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Register
                                        New Admin</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">View
                                        All Registered Admins</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Calendar</a>
                                </li>
                            </ul>
                            {{-- CONTENTS DROPDOWN - END --}}
                        </li>


                    </ul>

                    <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
                        <li>
                            <a href="#"
                                class="flex items-center p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                                <svg aria-hidden="true"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-3">Docs</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                                <svg aria-hidden="true"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                                    </path>
                                </svg>
                                <span class="ml-3">Lorem Ipsum</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                                <svg aria-hidden="true"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-3">Lorem Ipsum</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
        {{-- END OF ADMIN SIDE BAR --}}


        {{-- ################################################################################################### --}}
        <main class="h-auto pt-20 w-full fixed">

            <div x-data="{ isSidebarOpen: true }" class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-row">
                {{-- START RESOURCE NAVBAR --}}
                <div class="h-screen w-64 bg-green-400 "
                    :class="{ ' hidden': !isSidebarOpen, ' block': isSidebarOpen }">

                    <div class="px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800"
                        style="height: calc(100% - 80px);">

                        {{-- START SIDEBAR CONTENTS --}}
                        <ul class="space-y-2 font-medium">
                            <li>
                                <a href="#"
                                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 22 21">
                                        <path
                                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                        <path
                                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                                    </svg>
                                    <span class="ms-3">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 18 18">
                                        <path
                                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                                    </svg>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Kanban</span>
                                    <span
                                        class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                                    <span
                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 20 18">
                                        <path
                                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                                    </svg>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 18 20">
                                        <path
                                            d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                                    </svg>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 18 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                                    </svg>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Sign In</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                                        <path
                                            d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z" />
                                        <path
                                            d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z" />
                                    </svg>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Sign Up</span>
                                </a>
                            </li>
                        </ul>
                        {{-- END SIDEBAR CONTENTS --}}

                    </div>
                </div>
                {{-- END RESOURCE NAVBAR --}}


                <div class="w-full">
                    {{-- START PAGE HEADING --}}
                    @if (isset($header))
                        <header class="bg-white shadow dark:bg-gray-800">
                            <div class="px-4 py-6 mx-auto flex items-center  ">
                                <div>
                                    <button @click="isSidebarOpen = !isSidebarOpen">
                                        <i x-show="!isSidebarOpen"
                                            class="fa-solid fa-bars dark:text-white mx-3 text-2xl cursor-pointer"></i>
                                        <i x-show="isSidebarOpen"
                                            class="fa-solid fa-bars-staggered dark:text-white mx-3 text-2xl cursor-pointer"></i>
                                    </button>
                                </div>

                                {{ $header }}
                            </div>
                        </header>
                    @endif
                    {{-- END PAGE HEADING --}}

                    {{-- START PAGE CONTENT --}}
                    <div class=" overflow-y-auto" style="height: calc(100vh - 160px);">
                        <div class="border border-red-500 h-[105vh] w-full dark:text-white">
                            mahabang content
                        </div>
                        {{ $slot }}
                        i got two more contents here to show
                    </div>
                    {{-- END PAGE CONTENT --}}
                </div>
            </div>

        </main>
    </div>
    {{-- END OF ADMIN LAYOUT WITH 2 SIDE BAR --}}


    {{-- FlowBite CDN Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    {{-- <script>
        const toggleButtonForAdminSidebar = document.getElementById('toggle-button-for-admin-sidebar');
        const menuIconForSideBar = document.getElementById('menu-icon-for-admin-sidebar');
        const closeIconForSideBar = document.getElementById('close-icon-for-admin-sidebar');

        document.addEventListener('DOMContentLoaded', function() {
            toggleButtonForAdminSidebar.addEventListener('click', function() {
                // Toggle visibility of the icons
                menuIconForSideBar.classList.toggle('hidden');
                closeIconForSideBar.classList.toggle('hidden');
            });


        });
    </script> --}}
</body>

</html>
