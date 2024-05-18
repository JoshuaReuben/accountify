<?php

use Livewire\Volt\Component;

new class extends Component {
    public $month;
    public $year;
    public $daysInMonth;
    public $firstDayOfMonth;
    public $selectedDay;

    public $daysInWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    public $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']; // Full name of the months

    public function mount()
    {
        $this->month = now()->month;
        $this->year = now()->year;
        $this->calculateDaysInMonth();
    }

    public function today()
    {
        $this->month = now()->month;
        $this->year = now()->year;
        $this->calculateDaysInMonth();
    }

    public function prevMonth()
    {
        $this->month -= 1;
        if ($this->month < 1) {
            $this->month = 12;
            $this->year -= 1;
        }
        $this->calculateDaysInMonth();
    }

    public function nextMonth()
    {
        $this->month += 1;
        if ($this->month > 12) {
            $this->month = 1;
            $this->year += 1;
        }
        $this->calculateDaysInMonth();
    }

    private function calculateDaysInMonth()
    {
        $this->daysInMonth = now()->create($this->year, $this->month, 1)->daysInMonth;
        $this->firstDayOfMonth = now()->create($this->year, $this->month, 1)->dayOfWeek; // Sunday = 0, Monday = 1, ..., Saturday = 6
    }

    public function selectDay($year, $month, $day)
    {
        $this->selectedDay = now()->create($year, $month, $day)->format('Y-m-d');
    }
}; ?>


<div>

    <div>
        <h1 class="text-center">CALENDAR</h1>
        <div class="text-center"> {{ $months[$month - 1] }} {{ $year }} </div>
        <button wire:click="prevMonth" type="button"
            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
            Prev
        </button>
        <button wire:click="nextMonth" type="button"
            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
            Next
        </button>
        <button wire:click="today" type="button"
            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
            Today
        </button>



        <br><!-- Display the calendar days -->
        <div class="bg-gray-50 dark:bg-gray-800 ">
            {{-- Header Week Days --}}
            <div class="grid grid-cols-7 text-center">
                @foreach ($daysInWeek as $day)
                    <div class="py-1 text-xs border border-gray-600 md:text-md lg:text-lg md:p-4 dark:border-gray-500">
                        {{ $day }}
                    </div>
                @endforeach
            </div>

            <div wire:loading wire:target="prevMonth, nextMonth, today"
                class="w-full h-full py-1 text-center border border-gray-600 md:p-4 dark:border-gray-500">
                Loading ...
            </div>

            <div class="relative grid grid-cols-7 text-center">
                {{-- Trailing Filler Box  --}}
                @for ($i = 0; $i < $firstDayOfMonth; $i++)
                    <div wire:loading.remove wire:target="prevMonth, nextMonth, today"
                        class='py-1 border border-gray-600 md:p-4 dark:border-gray-500'></div>
                @endfor

                @for ($day = 1; $day <= $daysInMonth; $day++)
                    <div wire:loading.remove wire:target="prevMonth, nextMonth, today"
                        wire:click="selectDay({{ $year }}, {{ $month }}, {{ $day }})"
                        class='py-1 border border-gray-600 cursor-pointer md:p-4 dark:border-gray-500 dark:hover:bg-gray-900 hover:bg-slate-200 hover:font-bold'>
                        {{ now()->create($year, $month, $day)->format('j') }}
                    </div>
                @endfor
            </div>

        </div>

        <h1>Selected Full Date: {{ $selectedDay ?? now()->format('Y-m-d') }} </h1>
    </div>

</div>
