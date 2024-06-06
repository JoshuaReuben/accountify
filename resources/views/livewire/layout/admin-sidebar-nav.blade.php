<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <aside
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidenav" id="drawer-navigation">
        <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">

            <ul class="space-y-2">

                {{-- SCRATCH --}}
                <li class="mt-4">
                    <a href="{{ route('admin.scratch') }}"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <x-svgs.pie-chart-icon />
                        <span class="ml-3">scratch</span>
                    </a>
                </li>

                {{-- PAYPAL --}}
                <li class="mt-4">
                    <a href="{{ route('admin.paypal') }}"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <x-svgs.pie-chart-icon />
                        <span class="ml-3">PAYPAL</span>
                    </a>
                </li>


                {{-- UPLOAD A MUSIC --}}
                <li class="mt-4 group">
                    <a href="{{ route('admin.create.music') }}"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fa-solid fa-cloud-arrow-up text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ml-3">UPLOAD A MUSIC</span>
                    </a>
                </li>


                {{-- OVERVIEW --}}
                <li class="mt-4">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <x-svgs.pie-chart-icon />
                        <span class="ml-3">Overview</span>
                    </a>
                </li>

                {{-- PATIENTS DROPDOWN --}}
                <li>
                    <button type="button"
                        class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-patients" data-collapse-toggle="dropdown-patients">

                        {{-- ICON - START --}}
                        <x-svgs.user-icon />

                        {{-- ICON - END  --}}


                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Patients</span>

                        {{-- ARROW - START --}}
                        <x-svgs.dropdown-arrow-icon />
                        {{-- ARROW - END --}}
                    </button>

                    {{-- CONTENTS DROPDOWN - START --}}
                    <ul id="dropdown-patients" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.create.patient') }}"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Register
                                New Patient</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.index.patient') }}"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">View
                                Patient Records</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Calendar</a>
                        </li>
                    </ul>
                    {{-- CONTENTS DROPDOWN - END --}}
                </li>


                {{-- ---------------------------------------------------------- --}}

                {{-- SALES DROPDOWN --}}
                <li>
                    <button type="button"
                        class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-sales" data-collapse-toggle="dropdown-sales">

                        {{-- ICON - START --}}
                        <x-svgs.sales-bag-icon />
                        {{-- ICON - END  --}}

                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Sales</span>

                        {{-- ARROW - START --}}
                        <x-svgs.dropdown-arrow-icon />
                        {{-- ARROW - END --}}

                    </button>
                    <ul id="dropdown-sales" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Products</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Billing</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Invoice</a>
                        </li>
                    </ul>
                </li>


                {{-- AUTHENTICATION DROPDOWN --}}

                <li>
                    <button type="button"
                        class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-authentication" data-collapse-toggle="dropdown-authentication">

                        {{-- ICON - START --}}
                        <x-svgs.padlock-icon />
                        {{-- ICON - END  --}}


                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Authentication</span>

                        {{-- ARROW - START --}}
                        <x-svgs.dropdown-arrow-icon />
                        {{-- ARROW - END --}}
                    </button>

                    {{-- CONTENTS DROPDOWN - START --}}
                    <ul id="dropdown-authentication" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Register
                                New Admin</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">View
                                All Registered Admins</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Calendar</a>
                        </li>
                    </ul>
                    {{-- CONTENTS DROPDOWN - END --}}
                </li>


            </ul>

            <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
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
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
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
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
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
