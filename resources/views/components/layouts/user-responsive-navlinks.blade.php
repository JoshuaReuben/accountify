@props(['isDesktopView' => true])

@php
    $links = [
        ['name' => 'Learnings', 'routeIs' => 'dashboard'],
        ['name' => 'Flashcards', 'routeIs' => 'user.profile'],
        ['name' => 'My Scores', 'routeIs' => 'user.account'],
        ['name' => 'Achievements', 'routeIs' => 'user.page1'],
    ];
@endphp

<div class="{{ $isDesktopView == true ? 'flex' : '' }}">

    {{-- Desktop View --}}
    @if ($isDesktopView == true)
        @foreach ($links as $link)
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route($link['routeIs'])" :active="request()->routeIs($link['routeIs'])" wire:navigate>
                    {{ $link['name'] }}
                </x-nav-link>
            </div>
        @endforeach
    @endif

    {{-- ------------------------------------------------------------------------------------------------- --}}


    {{-- Mobile View --}}
    @if ($isDesktopView == false)

        @foreach ($links as $link)
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route($link['routeIs'])" :active="request()->routeIs($link['routeIs'])" wire:navigate>
                    {{ $link['name'] }}
                </x-responsive-nav-link>
            </div>
        @endforeach
    @endif




</div>
