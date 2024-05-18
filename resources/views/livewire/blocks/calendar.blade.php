<?php

use Livewire\Volt\Component;

new class extends Component {
    public $month;
    public $year;
    public $daysInMonth;
    public $firstDayOfMonth;

    public $daysInWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

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
}; ?>


<div>

    <div>
        <h1 class="text-center">Calendar</h1>
        <div class="text-center">Month: {{ $month }} Year: {{ $year }} </div>
        <button wire:click="prevMonth" class="p-4 m-4 border">Prev</button>
        <button wire:click="nextMonth" class="p-4 m-4 border">Next</button>
        <button wire:click="today" class="p-4 m-4 border">Today</button>


        <br><!-- Display the calendar days -->
        {{-- Header Week Days --}}
        <div class="grid grid-cols-7 text-center">
            @foreach ($daysInWeek as $day)
                <div class="py-1 border border-gray-600 md:p-4 dark:border-white">{{ $day }}
                </div>
            @endforeach
        </div>
        <div wire:loading wire:target="prevMonth, nextMonth, today"
            class="w-full h-full py-1 text-center border border-gray-600 md:p-4 dark:border-white">
            Loading ...
        </div>

        <div class="relative grid grid-cols-7 text-center">
            @for ($i = 0; $i < $firstDayOfMonth; $i++)
                <div wire:loading.remove wire:target="prevMonth, nextMonth, today"
                    class='py-1 border border-gray-600 md:p-4 dark:border-white'></div>
            @endfor
            @for ($day = 1; $day <= $daysInMonth; $day++)
                <div wire:loading.remove wire:target="prevMonth, nextMonth, today"
                    class='py-1 border border-gray-600 md:p-4 dark:border-white'>
                    {{ now()->create($year, $month, $day)->format('j') }}
                </div>
            @endfor


        </div>
    </div>

</div>
