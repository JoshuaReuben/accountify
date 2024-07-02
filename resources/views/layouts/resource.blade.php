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
                        {{-- <svg id="close-icon-for-admin-sidebar" class="hidden w-6 h-6 " fill="currentColor"
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
                                <div>
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
{{-- AJAX --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</html>
