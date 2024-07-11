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

                    {{-- <x-flashcard /> --}}




                    {{--  --}}

                </div>
            </div>
        </div>
    </div>
    {{-- END OF EXPERIMENT --}}


    {{-- END SECTION --}}
    @php
        $myArr = [
            ['question' => '1 asdf', 'answer' => 'asdf'],
            ['question' => '2 answeasdfasdfasfr2', 'answer' => 'answeasdfasdfasfr2'],
            [
                'question' =>
                    '3 answeasdfasdfasfr2answeasdfasdfasfr2answeasdfasdfasfr2answeasdfasdfasfr2answeasdfasdfasfr2',
                'answer' =>
                    'answeasdfasdfas fr2answeasdfasdfas fr2answeasdfasdfasfr2answ easdfasdfasfr2answeasdfa sdfasfr2answeasdfasdfasfr2a nsweasdfasdfasfr2answeasdfa sdfasfr2answeasdfasdfasfr2answeasdfa sdfasfr2answeasdfasdfasfr2answeasdfas dfasfr2answeasdfasdfasfr2answeasdfasdfasf r2answeasdfasdfasfr2answeasdfasd fasfr2answeasdfasdfasfr2answeasdfa sdfasfr2answeasdfasd fasfr2answeasdfasdfasfr2answeasdfasdfasfr2answe asdfasdfasfr2answeasdfasdfasfr2answeasdfasdfasfr2answeasdfasdfasfr2',
            ],
        ];
    @endphp

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{--  --}}
                    <div x-data="setupCarousel({{ json_encode($myArr) }})" class="relative w-full h-full overflow-hidden border border-green-500">

                        <!-- previous button -->
                        <button type="button"
                            class="absolute z-20 flex items-center justify-center p-2 transition -translate-y-1/2 rounded-full left-5 top-1/2 bg-white/40 text-slate-700 hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                            aria-label="previous slide" x-on:click="previous()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                fill="none" stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>

                        <!-- next button -->
                        <button type="button"
                            class="absolute z-20 flex items-center justify-center p-2 transition -translate-y-1/2 rounded-full right-5 top-1/2 bg-white/40 text-slate-700 hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                            aria-label="next slide" x-on:click="next()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                fill="none" stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>

                        <!-- slides -->
                        <div class="relative min-h-[400px] md:min-h-[600px] w-full flex justify-center items-center">



                            @foreach ($myArr as $key => $slide)
                                <div x-show="currentSlideIndex == {{ $key }} + 1" class="absolute "
                                    x-transition.opacity.duration.1000ms>

                                    <!-- START slide content -->
                                    {{-- {{ $slide['question'] }} --}}
                                    <x-flashcard question="{{ $slide['question'] }}"
                                        answer=" {{ $slide['answer'] }}}" />

                                    <!-- END slide content -->


                                </div>
                            @endforeach






                            {{-- <template x-for="(slide, index) in slides">
                                <div x-show="currentSlideIndex == index + 1" class="absolute bg-red-500 "
                                    x-transition.opacity.duration.1000ms>
                                    <!-- START slide content -->
                                  
                                    <x-flashcard :question="'slide.question'" :answer="'slide.answer'" />
                                    <!-- END slide content -->
                                </div>
                            </template> --}}
                        </div>

                    </div>

                    {{--  --}}
                </div>
            </div>
        </div>
    </div>





    <script>
        function setupCarousel(mySlides) {

            return {
                slides: mySlides,
                currentSlideIndex: 1,
                previous() {
                    if (this.currentSlideIndex > 1) {
                        this.currentSlideIndex = this.currentSlideIndex - 1
                    } else {
                        // If it's the first slide, go to the last slide           
                        this.currentSlideIndex = this.slides.length
                    }
                },
                next() {
                    if (this.currentSlideIndex < this.slides.length) {
                        this.currentSlideIndex = this.currentSlideIndex + 1
                    } else {
                        // If it's the last slide, go to the first slide    
                        this.currentSlideIndex = 1
                    }
                },
            }
        }
    </script>



</div>
