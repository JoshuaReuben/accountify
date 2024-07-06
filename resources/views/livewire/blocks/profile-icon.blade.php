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
    <x-dropdown
        contentClasses="absolute top-1 right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
        <x-slot name="trigger">
            <div type="button"
                class="flex mx-1 md:mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 cursor-pointer"
                id="user-menu-button">
                <img class="h-7 w-7 md:w-8 md:h-8 rounded-full"
                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png"
                    alt="user photo" />
            </div>
        </x-slot>
        <x-slot name="content">
            <ul class=" text-gray-700 dark:text-gray-300">
                <li class="">
                    <a href="{{ route('profile') }}"
                        class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-100 dark:hover:text-white rounded-t-xl">
                        My profile
                    </a>
                </li>
                <li
                    class="hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-100 dark:hover:text-white rounded-b-lg">
                    <button wire:click="logout" class="block py-2 px-4 text-sm w-full h-full text-left">
                        Sign Out
                    </button>
                </li>
            </ul>
        </x-slot>
    </x-dropdown>
</div>
