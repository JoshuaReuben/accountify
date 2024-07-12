@props(['title' => 'Title Here', 'content' => 'Content Here', 'trigger' => ''])
<div class="relative group inline-block">

    <div class="inline-block">
        @if ($trigger == '')
            <i class="fa-solid fa-circle-info opacity-50 hover:opacity-100"></i>
        @else
            {{ $trigger }}
        @endif
    </div>


    <div
        class="absolute top-1/2 -translate-y-1/2 ml-2 z-10 hidden group-hover:inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm  dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
        <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
            <h3 class="font-semibold text-gray-900 dark:text-white">{{ $title }}</h3>
        </div>
        <div class="px-3 py-2">
            {{ $content }}
        </div>
    </div>
</div>
