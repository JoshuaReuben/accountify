<div>

    {{-- COUNTDOWN INDICATOR --}}
    <p id="countdown">25:00</p>




    <div x-data="{ open: true }" class="flex  items-center">

        {{-- Reset --}}
        <button class="mx-2" @click="open = true " onclick="resetCountdown()">
            <x-svgs.reset-button-icon />
        </button>

        {{-- Play --}}
        <button class="mx-2" @click="open = ! open" x-show="open" onclick="startCountdown()">
            <x-svgs.play-button-icon />
        </button>

        {{-- Pause --}}
        <button class="mx-2" @click="open = ! open" x-show="!open" onclick="pauseCountdown()">
            <x-svgs.pause-button-icon />
        </button>

        {{-- Edit Modal --}}
        <button class="mx-2" data-modal-target="edit-timer" data-modal-toggle="edit-timer">
            <x-svgs.edit-icon />
        </button>

    </div>



    {{-- MODAL --}}

    <!-- Main modal -->
    <div id="edit-timer" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Timer
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="edit-timer">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-center text-gray-500 dark:text-gray-400">
                        The Pomodoro Technique is a time management method developed by Francesco Cirillo in the late
                        1980s. It uses a kitchen timer to break work into intervals, typically 25 minutes in length,
                        separated by short breaks.
                    </p>
                    {{-- HR - START --}}
                    <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-900">
                    {{-- HR - END --}}

                    <form class="w-full  mx-auto flex flex-wrap justify-center items-center">
                        {{-- MINUTES --}}
                        <div class="mx-2">
                            <label for="minutes-input" class="sr-only">Choose Minutes:</label>
                            <div class="relative flex items-center mb-2">
                                {{-- Minus Icon --}}
                                <button type="button" id="decrement-button"
                                    data-input-counter-decrement="minutes-input"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>
                                <input type="text" id="minutes-input" data-input-counter data-input-counter-min="1"
                                    data-input-counter-max="60"
                                    class="bg-gray-50 border-x-0 border-gray-300 h-11 font-medium text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pb-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="" value="25" required />
                                <div
                                    class="absolute bottom-1 start-1/2 -translate-x-1/2 rtl:translate-x-1/2 flex items-center text-xs text-gray-400 space-x-1 rtl:space-x-reverse">
                                    <span>MINUTES</span>
                                </div>
                                {{-- Plus Icon --}}
                                <button type="button" id="increment-button"
                                    data-input-counter-increment="minutes-input"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- SECONDS --}}
                        <div class="mx-2">
                            <label for="seconds-input" class="sr-only">Choose Seconds:</label>
                            <div class="relative flex items-center mb-2">
                                <button type="button" id="decrement-button"
                                    data-input-counter-decrement="seconds-input"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    {{-- Minus Icon --}}
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>
                                <input type="text" id="seconds-input" data-input-counter data-input-counter-min="0"
                                    data-input-counter-max="59"
                                    class="bg-gray-50 border-x-0 border-gray-300 h-11 font-medium text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pb-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="" value="0" required />
                                <div
                                    class="absolute bottom-1 start-1/2 -translate-x-1/2 rtl:translate-x-1/2 flex items-center text-xs text-gray-400 space-x-1 rtl:space-x-reverse">
                                    <span>SECONDS</span>
                                </div>
                                <button type="button" id="increment-button"
                                    data-input-counter-increment="seconds-input"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>


                    </form>

                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button onclick="updateStartingTime()" data-modal-hide="edit-timer" type="button"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Save Changes
                    </button>
                    <button data-modal-hide="edit-timer" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>



    {{-- JAVASCRIPT --}}

    <script>
        const countdownEl = document.getElementById('countdown');
        let startingMinutes = 25;

        let time = startingMinutes * 60;
        let intervalID = null;


        // If there is a key 'set:Minutes' and 'set:Seconds' stored in storage, save that to the form for setting the timer
        if (localStorage.getItem('set:Minutes') && localStorage.getItem('set:Seconds')) {
            document.getElementById("minutes-input").value = parseInt(localStorage.getItem('set:Minutes'));
            document.getElementById("seconds-input").value = parseInt(localStorage.getItem('set:Seconds'));
        }

        // If there is a key 'time' stored in storage, then use that value as the time then update the innerHTML
        if (localStorage.getItem('time')) {
            time = parseInt(localStorage.getItem('time'));
            updateCountdown();
        } else {
            updateCountdown();
        }

        function startCountdown() {
            clearInterval(intervalID); // Clear any existing interval before setting a new one
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

            if (time == 0 || time < 0) {
                clearInterval(intervalID); // Stop the interval

                // Reset the timer back to 1 minute and unset the 'time' key from storage
                resetCountdown();
            } else {
                time--;
            }
        }

        // Reset the timer back
        function resetCountdown() {
            // Stop the interval if it is currently running
            if (typeof intervalID !== 'undefined' && intervalID !== null) {
                clearInterval(intervalID);
            }

            if (localStorage.getItem('set:Minutes') && localStorage.getItem('set:Seconds')) {
                setMinutes = parseInt(localStorage.getItem('set:Minutes'));
                setSeconds = parseInt(localStorage.getItem('set:Seconds'));
                time = (setMinutes * 60) + setSeconds;
            } else {
                time = startingMinutes * 60;
            }
            updateCountdown();


        }


        // Function to update the startingMinutes based on the input field
        function updateStartingTime() {
            const minutesInput = document.getElementById('minutes-input');
            const secondsInput = document.getElementById('seconds-input');
            startingMinutes = parseInt(minutesInput.value);
            time = startingMinutes * 60;
            // Add the inputted seconds to the time
            time += parseInt(secondsInput.value);
            updateCountdown(); // Update the countdown display immediately

            localStorage.setItem('set:Minutes', minutesInput.value);
            localStorage.setItem('set:Seconds', secondsInput.value);
        }
    </script>
</div>
