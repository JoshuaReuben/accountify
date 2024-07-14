@props(['color' => 'green', 'title' => 'Success', 'message' => 'Saved.'])

{{-- Requires Sessions to show -- needed at redirects --}}

<div x-data="{ shown: false, timeout: null }" x-init="shown = true;
timeout = setTimeout(() => { shown = false }, 2000);" x-transition:enter="transform transition-transform duration-300"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transform transition-transform duration-300" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-full" x-show="shown" @click="shown = false"
    {{ $attributes->merge(['class' => 'fixed z-50 bottom-10 right-8 w-[300px]']) }}>
    {{--  Content --}}
    <div class=" w=[300px] flex items-center p-4 mb-4 text-sm text-{{ $color }}-800 border border-{{ $color }}-300 rounded-lg bg-{{ $color }}-50 cursor-pointer"
        role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>

        <div>
            <span class="font-medium">{{ $title }}!</span> {{ $message }}
        </div>
    </div>
    {{-- End Content --}}
</div>
