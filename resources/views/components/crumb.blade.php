<div class="flex">
    <li class="inline-flex items-center py-3">
        &nbsp; / &nbsp;

        <a href="{{ $href ?? '#' }}"
            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">

            {{ $slot }}
        </a>

    </li>

</div>
