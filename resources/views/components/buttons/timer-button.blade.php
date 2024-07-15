<div>

    <x-dropdown width="w-full"
        contentClasses="absolute top-0 right-0 z-10 mt-2 w-full origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
        <x-slot name="trigger">
            <button type="button" id="countdown"
                class="w-full text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-bold rounded-lg text-sm md:text-md px-2.5 py-1.5 md:px-5 md:py-2.5 text-center me-2 mb-2">
                25:00
            </button>
        </x-slot>
        <x-slot name="content">
            <!-- Dropdown menu -->
            <div class="z-10 bg-white rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="text-sm text-gray-700 dark:text-gray-200">
                    <button id="timer-reset-btn" onclick="resetCountdown(); toggleResetforPlayBtn()"
                        class="flex items-center w-full p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:rounded-lg">
                        {{-- Reset --}}
                        <x-svgs.reset-button-icon />
                        &nbsp; Reset
                    </button>

                    <button id="timer-play-btn" onclick="startCountdown(); toggleTimerOpen()"
                        class="flex items-center w-full p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:rounded-lg">
                        {{-- Play --}}
                        <x-svgs.play-button-icon />
                        Play
                    </button>

                    <button id="timer-pause-btn" onclick="pauseCountdown(); toggleTimerOpen()"
                        class="items-center hidden w-full p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:rounded-lg">
                        {{-- Pause --}}
                        <x-svgs.pause-button-icon />
                        Pause
                    </button>

                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-timer')"
                        class="flex items-center w-full p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:rounded-lg">
                        {{-- Edit Modal --}}
                        <x-svgs.edit-icon />
                        Edit Timer
                    </button>
                </ul>
            </div>

        </x-slot>
    </x-dropdown>



    {{-- MODAL --}}

    <!-- Main modal -->
    <x-modal name="edit-timer" focus="true" bgColor="">
        <div class="w-full h-[90vh]  flex items-center justify-center">
            <div id="edit-timer" class="items-center justify-center w-full overflow-x-hidden overflow-y-auto">
                <div class="relative w-full max-w-2xl max-h-full p-4">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Edit Timer
                            </h3>
                            <button x-on:click="$dispatch('close')" type="button"
                                class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 space-y-4 md:p-5">
                            <p class="text-base leading-relaxed text-center text-gray-500 dark:text-gray-400">
                                The Pomodoro Technique is a time management method developed by Francesco Cirillo in the
                                late
                                1980s. It uses a kitchen timer to break work into intervals, typically 25 minutes in
                                length,
                                separated by short breaks.
                            </p>
                            {{-- HR - START --}}
                            <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-900">
                            {{-- HR - END --}}

                            <form x-data="setFormTimer()" x-init="init()"
                                class="flex flex-wrap items-center justify-center w-full mx-auto">
                                {{-- MINUTES --}}
                                <div class="mx-1">
                                    <div class="relative flex flex-col items-center mb-2">

                                        {{-- Plus Icon --}}
                                        <button type="button" id="increment-button-minutes"
                                            @click="if (minutes < 59) minutes++"
                                            class="px-5 py-3 bg-gray-100 border border-gray-300 rounded-t-lg dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-3 h-3 text-gray-900 dark:text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>

                                        </button>

                                        <input type="number" id="minutes-input"
                                            class="block w-full px-3 pt-6 text-sm font-medium text-center text-gray-900 border border-gray-300 pb-9 bg-gray-50 h-11 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" x-model="minutes"
                                            @input="minutes = Math.max(1, Math.min(59, minutes))" required
                                            min="1" max="59" />

                                        <div
                                            class="absolute  flex items-center text-2xs text-gray-400 bottom-[50px] w-full  justify-center">
                                            <span>MINUTES</span>
                                        </div>

                                        {{-- Minus Icon --}}
                                        <button type="button" id="decrement-button-minutes"
                                            @click="if (minutes > 1) minutes--"
                                            class="px-5 py-3 bg-gray-100 border border-gray-300 rounded-b-lg dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-3 h-3 text-gray-900 dark:text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                {{-- SECONDS --}}
                                <div class="">
                                    <div class="relative flex flex-col items-center mb-2">

                                        {{-- Plus Icon --}}
                                        <button type="button" id="increment-button-seconds"
                                            @click="if (seconds < 59) seconds++"
                                            class="px-5 py-3 bg-gray-100 border border-gray-300 rounded-t-lg dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-3 h-3 text-gray-900 dark:text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>

                                        </button>

                                        <input type="number" id="seconds-input"
                                            class="block w-full px-3 pt-6 text-sm font-medium text-center text-gray-900 border border-gray-300 pb-9 bg-gray-50 h-11 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" x-model="seconds"
                                            @input="seconds = Math.max(0, Math.min(59, seconds))" required
                                            min="0" max="59" />

                                        <div
                                            class="absolute  flex items-center text-2xs text-gray-400 bottom-[50px] w-full  justify-center">
                                            <span>SECONDS</span>
                                        </div>

                                        {{-- Minus Icon --}}
                                        <button type="button" id="decrement-button-seconds"
                                            @click="if (seconds > 0) seconds--"
                                            class="px-5 py-3 bg-gray-100 border border-gray-300 rounded-b-lg dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-3 h-3 text-gray-900 dark:text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600">
                            <button onclick="updateStartingTime()" type="button" x-on:click="$dispatch('close')"
                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Save Changes
                            </button>
                            <button x-on:click="$dispatch('close')" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-modal>



    {{-- JAVASCRIPT --}}

    <script>
        (function() {
            const countdownEl = document.getElementById('countdown');
            let timerPlayBtn = document.getElementById('timer-play-btn');
            let timerPauseBtn = document.getElementById('timer-pause-btn');

            let startingMinutes = 25;
            let startingSeconds = 0;
            let time = (startingMinutes * 60) + startingSeconds;
            let intervalID = null;

            function toggleResetforPlayBtn() {
                if (timerPauseBtn.classList.contains('flex')) {
                    timerPauseBtn.classList.remove('flex');
                    timerPauseBtn.classList.add('hidden');
                    timerPlayBtn.classList.remove('hidden');
                    timerPlayBtn.classList.add('flex');
                }
            }

            function toggleTimerOpen() {
                timerPlayBtn.classList.toggle('hidden');
                if (timerPauseBtn.classList.contains('hidden')) {
                    timerPauseBtn.classList.remove('hidden');
                    timerPauseBtn.classList.add('flex');
                } else {
                    timerPauseBtn.classList.remove('flex');
                    timerPauseBtn.classList.add('hidden');
                }
            }

            function startCountdown() {
                clearInterval(intervalID);
                intervalID = setInterval(updateCountdown, 1000);
            }

            function pauseCountdown() {
                if (intervalID !== null) {
                    clearInterval(intervalID);
                }
            }

            function updateCountdown() {
                const minutes = Math.floor(time / 60);
                let seconds = time % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds;
                countdownEl.innerHTML = `${minutes}:${seconds}`;
                localStorage.setItem('time', time);

                if (time < 0) {
                    clearInterval(intervalID);
                    alert('Time is up! Take a short break!');
                    resetCountdown();
                    toggleResetforPlayBtn();
                } else {
                    time--;
                }
            }

            function resetCountdown() {
                if (intervalID !== null) {
                    clearInterval(intervalID);
                }
                if (localStorage.getItem('set:Minutes') && localStorage.getItem('set:Seconds')) {
                    const setMinutes = parseInt(localStorage.getItem('set:Minutes'));
                    const setSeconds = parseInt(localStorage.getItem('set:Seconds'));
                    time = (setMinutes * 60) + setSeconds;
                } else {
                    time = startingMinutes * 60;
                }
                updateCountdown();
                toggleResetforPlayBtn();
            }

            function updateStartingTime() {
                const minutesInput = document.getElementById('minutes-input');
                const secondsInput = document.getElementById('seconds-input');
                startingMinutes = parseInt(minutesInput.value);
                time = startingMinutes * 60;
                time += parseInt(secondsInput.value);
                updateCountdown();
                localStorage.setItem('set:Minutes', minutesInput.value);
                localStorage.setItem('set:Seconds', secondsInput.value);
                resetCountdown();
            }

            // Initial setup
            if (localStorage.getItem('set:Minutes') && localStorage.getItem('set:Seconds')) {
                document.getElementById("minutes-input").value = parseInt(localStorage.getItem('set:Minutes'));
                document.getElementById("seconds-input").value = parseInt(localStorage.getItem('set:Seconds'));
            }

            if (localStorage.getItem('time')) {
                time = parseInt(localStorage.getItem('time'));
                updateCountdown();
            } else {
                updateCountdown();
            }

            function setFormTimer() {
                return {
                    minutes: 25,
                    seconds: 0,

                    init() {
                        // Retrieve values from localStorage and update minutes and seconds if they exist
                        const storedMinutes = localStorage.getItem('set:Minutes');
                        const storedSeconds = localStorage.getItem('set:Seconds');

                        if (storedMinutes !== null) {
                            this.minutes = parseInt(storedMinutes);
                        }
                        if (storedSeconds !== null) {
                            this.seconds = parseInt(storedSeconds);
                        }
                    },

                }
            }

            // Exposing functions to global scope
            window.toggleResetforPlayBtn = toggleResetforPlayBtn;
            window.toggleTimerOpen = toggleTimerOpen;
            window.startCountdown = startCountdown;
            window.pauseCountdown = pauseCountdown;
            window.updateCountdown = updateCountdown;
            window.resetCountdown = resetCountdown;
            window.updateStartingTime = updateStartingTime;
            window.setFormTimer = setFormTimer;

        })();
    </script>



</div>
