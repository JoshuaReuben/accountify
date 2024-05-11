<nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Breadcrumb">
    <ol class="inline-flex flex-wrap items-center space-x-1 md:space-x-2 rtl:space-x-reverse">

        {{-- Initial --}}
        <div class="flex">
            <li class="inline-flex items-center py-3">

                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <x-svgs.home-icon />
                    Admin
                </a>

            </li>

        </div>
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @endif
    </ol>
</nav>
