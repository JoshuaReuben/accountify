<?php

use App\Livewire\Forms\AdminLoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Notifications\AdminEmailVerifyNotif;

// use Illuminate\Support\Facades\Auth;

new #[Layout('layouts.guest')] class extends Component {
    public AdminLoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->checkEmailVerified();

        // $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: false);
    }

    public function checkEmailVerified()
    {
        if (Auth::guard('admin')->user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: false);
        } else {
            //If not verified, send email then redirect to email notification page
            $user = Auth::guard('admin')->user();
            $user->generateVerificationToken();

            $user->notify(new AdminEmailVerifyNotif($user->id, $user->token));
            $this->redirectIntended(default: route('admin.verification.notice', absolute: false), navigate: false);
        }
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />




    <h1 class="mt-5 text-2xl font-extrabold text-center text-gray-900 mb-7 text-md dark:text-white md:text-2xl">
        <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">ADMIN</span> LOGIN
    </h1>


    {{-- Third Party Sign In --}}
    <x-buttons.google-button class="mt-4" href="/auth/google/redirect?admin=true" />
    <x-buttons.facebook-button class="mt-4" href="/auth/facebook/redirect?admin=true" />


    {{-- Session Message No Admin Account found --}}
    @if (session('message'))
        <div class="flex items-center p-4 my-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Failed!</span> {{ session('message') }}
            </div>
        </div>
    @endif

    {{-- Divider --}}
    <div class="flex items-center justify-between mt-8 mb-4">
        <span class="w-1/5 border-b lg:w-1/4"></span>
        <a class="text-xs text-center text-gray-500 uppercase">or login with email</a>
        <span class="w-1/5 border-b lg:w-1/4"></span>
    </div>

    <form wire:submit="login" class="mb-8">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block w-full mt-1" type="email" name="email"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex justify-between">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>


            <x-text-input wire:model="form.password" id="password" class="block w-full mt-1" type="password"
                name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">


            <x-buttons.primary-button class="w-full mx-auto">
                <span class="w-full text-center"> {{ __('Log in') }}</span>
            </x-buttons.primary-button>
        </div>
    </form>




</div>
