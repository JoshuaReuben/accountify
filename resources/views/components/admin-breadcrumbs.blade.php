<nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Breadcrumb">
    <ol class="inline-flex flex-wrap items-center space-x-1 md:space-x-2 rtl:space-x-reverse">

        {{-- Initial - 1st level --}}
        <div class="flex">
            <li class="inline-flex items-center py-3">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <x-svgs.home-icon />
                    Admin
                </a>
            </li>
        </div>

        {{-- Succeeding - 2nd level --}}
        {{-- request()->routeIs('dashboard') --}}


        {{-- PAYPAL --}}
        @if (request()->routeIs('admin.paypal'))
            <x-crumb href="{{ route('admin.paypal') }}">
                <x-svgs.pie-chart-icon class="mr-2 h-[15px] w-[15px]" />
                Paypal
            </x-crumb>
        @endif


        {{-- DASHBOARD --}}
        @if (request()->routeIs('admin.dashboard'))
            <x-crumb href="{{ route('admin.dashboard') }}">
                <x-svgs.pie-chart-icon class="mr-2 h-[15px] w-[15px]" />
                Overview
            </x-crumb>
        @endif

        {{-- CREATE PATIENT --}}
        @if (request()->routeIs('admin.create.patient'))
            <x-crumb href="{{ route('admin.create.patient') }}">
                <x-svgs.user-icon class="mr-2 h-[12px] w-[12px]" />
                Register Patient
            </x-crumb>
        @endif

        {{-- INDEX PATIENT --}}
        @if (request()->routeIs('admin.index.patient'))
            <x-crumb href="{{ route('admin.index.patient') }}">
                <x-svgs.user-icon class="mr-2 h-[12px] w-[12px]" />
                View Patients
            </x-crumb>
        @endif


        @if ($slot->isNotEmpty())
            {{ $slot }}
        @endif
    </ol>
</nav>
