<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/');
    }
}; ?>


<div>
    <button type="button"
        class="flex mx-1 md:mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
        <span class="sr-only">Open user menu</span>
        <img class="h-7 w-7 md:w-8 md:h-8 rounded-full"
            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png" alt="user photo" />
    </button>

    <!-- Dropdown menu -->
    <div class="hidden  z-50 my-4 w-56 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
        id="dropdown">
        <div class="py-3 px-4">
            <span class="block text-sm font-semibold text-gray-900 dark:text-white">
                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name">
                </div>
            </span>
            <span class="block text-sm text-gray-900 truncate dark:text-slate-400">{{ auth()->user()->email }}</span>
        </div>
        <ul class=" text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
            <li>
                <a href="{{ route('profile') }}"
                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">My
                    profile</a>
            </li>
            <li class="hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white rounded-b-xl">
                <button wire:click="logout" href="#" class="block py-2 px-4 text-sm ">Sign
                    Out</button>
            </li>
        </ul>

    </div>
</div>
