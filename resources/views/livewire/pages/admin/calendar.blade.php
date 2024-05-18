<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.admin')] class extends Component {
    public $month;
    public $year;
    public $daysInMonth;
    public $firstDayOfMonth;

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
};

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

                    <div>
                        <h1 class="text-center">Calendar</h1>
                        <div class="text-center">Month: {{ $month }} Year: {{ $year }} </div>
                        <button wire:click="prevMonth" class="p-4 m-4 border">Prev</button>
                        <button wire:click="nextMonth" class="p-4 m-4 border">Next</button>
                        <button wire:click="today" class="p-4 m-4 border">Today</button>


                        <br><!-- Display the calendar days -->
                        <div class="grid grid-cols-7">
                            <div class="p-4 border border-white">Sun</div>
                            <div class="p-4 border border-white">Mon</div>
                            <div class="p-4 border border-white">Tue</div>
                            <div class="p-4 border border-white">Wed</div>
                            <div class="p-4 border border-white">Thu</div>
                            <div class="p-4 border border-white">Fri</div>
                            <div class="p-4 border border-white">Sat</div>
                        </div>
                        <div class="grid grid-cols-7">
                            @for ($i = 0; $i < $firstDayOfMonth; $i++)
                                <div class='p-4 border border-white'></div>
                            @endfor
                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                <div class='p-4 border border-white'>
                                    {{ now()->create($year, $month, $day)->format('j') }}
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- END SECTION --}}


                    {{-- ---------------------- --}}
                </div>
            </div>
        </div>
    </div>
</div>
