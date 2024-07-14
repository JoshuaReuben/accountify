<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */

    public $passed_user;

    public function mount()
    {
        if (Auth::guard('admin')->check()) {
            $this->passed_user = Auth::guard('admin')->user();
        } else {
            $this->passed_user = Auth::user();
        }
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/');
    }
}; ?>


<div>
    <x-dropdown
        contentClasses="absolute top-1 right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
        <x-slot name="trigger">
            <div type="button"
                class="flex mx-1 text-sm bg-gray-800 rounded-full cursor-pointer md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                id="user-menu-button">

                {{-- Image as DIV --}}
                <div class="mx-auto border border-gray-500 rounded-full w-11 h-11 "
                    style="background-image: url('/storage/{{ $passed_user->avatar }}'); background-size: cover; background-position: center">
                </div>


            </div>
        </x-slot>
        <x-slot name="content">
            <ul class="text-gray-700 dark:text-gray-300">
                <li class="">
                    @if (Auth::guard('admin')->check())
                        <a href="{{ route('admin.profile') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-100 dark:hover:text-white rounded-t-xl">
                            My Admin Profile
                        </a>
                    @else
                        <a href="{{ route('profile') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-100 dark:hover:text-white rounded-t-xl">
                            My profile
                        </a>
                    @endif

                </li>
                <li
                    class="rounded-b-lg hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-100 dark:hover:text-white">
                    <button wire:click="logout" class="block w-full h-full px-4 py-2 text-sm text-left">
                        Sign Out
                    </button>
                </li>
            </ul>
        </x-slot>
    </x-dropdown>
</div>
