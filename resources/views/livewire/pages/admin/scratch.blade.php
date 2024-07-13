<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.admin')] class extends Component {
    public $data = 'Initial Data';
    public function updateData()
    {
        $this->data = 'Updated Data';
    }
};

?>

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{-- START - BREADCRUMBS --}}
            <x-admin-breadcrumbs />

            {{-- END - BREADCRUMBS --}}
        </h2>
    </x-slot>


    {{-- Success Email Verification --}}
    @if (session('status'))
        <div class="flex items-center p-4 my-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Success!</span> {{ session('status') }}
            </div>
        </div>
    @endif


    {{-- Failed Email Verification --}}
    @if (session('error'))
        <div class="flex items-center p-4 my-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Failed!</span> {{ session('error') }}
            </div>
        </div>
    @endif



    {{--  EXPERIMENT --}}
    <div class="py-12">
        <div class="px-0 mx-auto max-w-7xl sm:px-2 ">
            <div class="bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="px-8 py-4 text-gray-900 dark:text-gray-100">

                    {{--  --}}
                    <!-- component -->
                    {{-- <div class="h-screen bg-gray-200  dark:bg-gray-800   flex flex-wrap items-center  justify-center  ">
                        <div
                            class="container lg:w-2/6 xl:w-2/7 sm:w-full md:w-2/3    bg-white  shadow-lg    transform   duration-200 easy-in-out">
                            <div class=" h-32 overflow-hidden">
                                <img class="w-full"
                                    src="https://images.unsplash.com/photo-1605379399642-870262d3d051?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80"
                                    alt="" />
                            </div>
                            <div class="flex justify-center px-5  -mt-12">
                                <img class="h-32 w-32 bg-white p-2 rounded-full   "
                                    src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80"
                                    alt="" />

                            </div>
                            <div class=" ">
                                <div class="text-center px-14">
                                    <h2 class="text-gray-800 text-3xl font-bold">Mohit Dhiman</h2>
                                    <a class="text-gray-400 mt-2 hover:text-blue-500"
                                        href="https://www.instagram.com/immohitdhiman/"
                                        target="BLANK()">@immohitdhiman</a>
                                    <p class="mt-2 text-gray-500 text-sm">Lorem Ipsum is simply dummy text of the
                                        printing and typesetting industry. Lorem Ipsum has been the industry's standard
                                        dummy text ever since the 1500s, </p>
                                </div>
                                <hr class="mt-6" />
                                <div class="flex  bg-gray-50 ">
                                    <div class="text-center w-1/2 p-4 hover:bg-gray-100 cursor-pointer">
                                        <p><span class="font-semibold">2.5 k </span> Followers</p>
                                    </div>
                                    <div class="border"></div>
                                    <div class="text-center w-1/2 p-4 hover:bg-gray-100 cursor-pointer">
                                        <p> <span class="font-semibold">2.0 k </span> Following</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{--  --}}

                    {{-- Profile --}}
                    <div class="p-16">
                        <div class="p-8 bg-white shadow mt-24">
                            <div class="grid grid-cols-1 md:grid-cols-3">
                                <div class="grid grid-cols-3 text-center order-last md:order-first mt-20 md:mt-0">
                                    <div>
                                        <p class="font-bold text-gray-700 text-xl">22</p>
                                        <p class="text-gray-400">Friends</p>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-700 text-xl">10</p>
                                        <p class="text-gray-400">Photos</p>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-700 text-xl">89</p>
                                        <p class="text-gray-400">Comments</p>
                                    </div>
                                </div>
                                <div class="relative">
                                    <div
                                        class="w-48 h-48 bg-indigo-100 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-24 flex items-center justify-center text-indigo-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center"><button
                                        class="text-white py-2 px-4 uppercase rounded bg-blue-400 hover:bg-blue-500 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                                        Connect</button> <button
                                        class="text-white py-2 px-4 uppercase rounded bg-gray-700 hover:bg-gray-800 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                                        Message</button> </div>
                            </div>
                            <div class="mt-20 text-center border-b pb-12">
                                <h1 class="text-4xl font-medium text-gray-700">Jessica Jones, <span
                                        class="font-light text-gray-500">27</span></h1>
                                <p class="font-light text-gray-600 mt-3">Bucharest, Romania</p>
                                <p class="mt-8 text-gray-500">Solution Manager - Creative Tim Officer</p>
                                <p class="mt-2 text-gray-500">University of Computer Science</p>
                            </div>
                            <div class="mt-12 flex flex-col justify-center">
                                <p class="text-gray-600 text-center font-light lg:px-16">An artist of considerable
                                    range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy —
                                    writes, performs and records all of his own music, giving it a warm, intimate feel
                                    with a solid groove structure. An artist of considerable range.</p> <button
                                    class="text-indigo-500 py-2 px-4  font-medium mt-4"> Show more</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- END OF EXPERIMENT --}}




</div>
