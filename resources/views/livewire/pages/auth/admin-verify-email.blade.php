<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Notifications\AdminEmailVerifyNotif;

new #[Layout('layouts.guest')] class extends Component {
    public function mount()
    {
        if (Session::has('initial-verification') && Session::get('initial-verification') === 'done') {
            return;
        } else {
            // If not verified, send email then redirect to email notification page
            $user = Auth::guard('admin')->user();
            $user->generateVerificationToken();

            $user->notify(new AdminEmailVerifyNotif($user->id, $user->token));

            // Mark the account that the initial email verification has been sent
            Session::put('initial-verification', 'done');
        }
    }

    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::guard('admin')->user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: false);

            return;
        }

        $user = Auth::guard('admin')->user();
        $user->generateVerificationToken();

        Auth::guard('admin')
            ->user()
            ->notify(new AdminEmailVerifyNotif($user->id, $user->token));

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up as the Admin! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif


    <div class="flex items-center justify-between mt-4">
        <x-buttons.primary-button wire:click="sendVerification">
            <div wire:loading wire:target="sendVerification">
                <x-svgs.spinner size="5" message="Sending Email" />
            </div>
            <span wire:loading.remove wire:target="sendVerification">{{ __('Resend Verification Email') }}</span>
        </x-buttons.primary-button>

        <button wire:click="logout" type="submit"
            class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            {{ __('Log Out') }}
        </button>
    </div>
</div>
