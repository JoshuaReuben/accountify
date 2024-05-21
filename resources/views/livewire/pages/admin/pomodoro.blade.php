<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.admin')] class extends Component {};

?>

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{-- START - BREADCRUMBS --}}
            <x-admin-breadcrumbs>

            </x-admin-breadcrumbs>
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

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}
                    <p id="countdown">1:00</p>
                    {{-- NOT YET CONFIGURED TO BECOME A RESET --}}
                    <button onclick="resetCountdown()">RESET</button>
                    <button onclick="startCountdown()">PLAY</button>
                    <button onclick="pauseCountdown()">PAUSE</button>




                    <script>
                        const countdownEl = document.getElementById('countdown');
                        const startingMinutes = 1;
                        let time = startingMinutes * 60;

                        // If there is a key 'time' stored in storage, then use that value as the time then update the innerHTML
                        if (localStorage.getItem('time')) {
                            time = parseInt(localStorage.getItem('time'));
                            updateCountdown();
                        }

                        // Start the timer
                        function startCountdown() {
                            intervalID = setInterval(updateCountdown, 1000);
                        }

                        // Pause the timer
                        function pauseCountdown() {
                            if (intervalID !== null) {
                                clearInterval(intervalID);
                            }
                        }
                        // Countdown timer function
                        function updateCountdown() {
                            const minutes = Math.floor(time / 60);
                            let seconds = time % 60;
                            seconds = seconds < 10 ? '0' + seconds : seconds;

                            countdownEl.innerHTML = `${minutes}:${seconds}`;

                            localStorage.setItem('time', time);

                            if (time == 0) {
                                clearInterval(intervalID); // Stop the interval
                            }
                            time--;
                        }

                        //problem, reset is not working properly, does not reset the timer back to 1 minute


                        // Reset the timer back to 1 minute and unset the 'time' key from storage
                        function resetCountdown() {
                            console.log(time);

                            time = startingMinutes * 60;
                            if (typeof intervalID !== 'undefined' && intervalID !== null) {
                                clearInterval(intervalID);
                            }

                            localStorage.removeItem('time');
                            countdownEl.innerHTML = '1:00';
                            console.log(time);

                        }
                    </script>

                    {{-- END SECTION --}}


                    {{-- ---------------------- --}}
                </div>
            </div>
        </div>
    </div>
</div>
