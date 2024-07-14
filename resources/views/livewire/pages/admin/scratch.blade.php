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


    {{--  EXPERIMENT --}}
    <div class="py-12">
        <div class="px-0 mx-auto max-w-7xl sm:px-2 ">
            <div class="bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="px-8 py-4 text-gray-900 dark:text-gray-100">
                    {{--  --}}

                    {{--  --}}


                </div>
            </div>
        </div>
    </div>
    {{-- END OF EXPERIMENT --}}




</div>
