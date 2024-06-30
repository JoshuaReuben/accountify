{{-- =========================================================================== --}}
{{-- This code is reserved for resources users Modules + Lessons --}}
<div class="flex w-full flex-col gap-4 text-slate-700 dark:text-slate-300">

    @forelse ($this->fetched_modules as  $module)
        {{-- START - Accordion --}}
        <div x-data="{ isExpanded: false }"
            class="divide-y divide-slate-300 overflow-hidden rounded-xl border border-slate-300 bg-slate-100/40 dark:divide-slate-700 dark:border-slate-700 dark:bg-slate-800/50">

            {{-- Accordion Head --}}
            <button id="controlsAccordionItemOne" type="button"
                class="flex w-full items-center justify-between gap-2 bg-slate-100 p-4 text-left underline-offset-2 hover:bg-slate-100/75 focus-visible:bg-slate-100/75 focus-visible:underline focus-visible:outline-none dark:bg-slate-800 dark:hover:bg-slate-800/75 dark:focus-visible:bg-slate-800/75"
                aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded"
                :class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold' :
                    'text-onSurface dark:text-onSurfaceDark font-medium'"
                :aria-expanded="isExpanded ? 'true' : 'false'">
                Module {{ $loop->iteration }}: {{ $module->module_name }}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2"
                    stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true"
                    :class="isExpanded ? 'rotate-180' : ''">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>

            {{-- Accordion Body --}}
            <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region"
                aria-labelledby="controlsAccordionItemOne" x-collapse>
                <div class="p-4 text-sm sm:text-base text-pretty">
                    Our website is optimized for the latest versions of Chrome, Firefox, Safari, and Edge. Check our
                    <a href="#"
                        class="underline underline-offset-2 text-blue-700 dark:text-blue-600">documentation</a> for
                    additional information.
                </div>
            </div>

        </div>
        {{-- END - Accordion --}}
    @empty
        <div class="p-6 italic text-center text-gray-900 dark:text-gray-100">
            <p>No Modules Added.</p>
        </div>
    @endforelse

</div>
