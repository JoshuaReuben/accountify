<div x-data="{ isExpanded: false }" class="divide-y ">

    <button type="button" class=" w-full  " @click="isExpanded = ! isExpanded"
        :class="isExpanded ? 'font-bold' : ' font-medium'">
        {{ $title }}
        {{-- Chevron Icon --}}
        {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="currentColor"
            class="size-5 shrink-0 transition" :class="isExpanded ? 'rotate-180' : ''">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg> --}}
    </button>

    <div x-cloak x-show="isExpanded" x-collapse>
        <div class="text-sm sm:text-base text-pretty">
            {{ $content }}
        </div>
    </div>
</div>
