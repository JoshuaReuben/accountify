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
                <x-crumb href="{{ route('admin.index.patient') }}">
                    <x-svgs.user-icon class="mr-2 h-[12px] w-[12px]" />
                    View Patients </x-crumb>
            </x-admin-breadcrumbs>
            {{-- END - BREADCRUMBS --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}

                    Table of Patients

                    {{-- END SECTION --}}


                    {{-- ---------------------- --}}
                </div>
            </div>
        </div>
    </div>
</div>
