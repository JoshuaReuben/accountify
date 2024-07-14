<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Notifications\AdminEmailVerifyNotif;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    use WithFileUploads;

    public $passed_user;
    public $avatar;

    public function mount()
    {
        if (Auth::guard('admin')->check()) {
            $this->passed_user = Auth::guard('admin')->user();
        } else {
            $this->passed_user = Auth::user();
        }
    }

    public function updateProfilePhoto()
    {
        $this->validate([
            'avatar' => ['required', 'image', 'max:4096'],
        ]);

        //Delete the Old Profile Photo before updating
        $fileExists = Storage::exists('public/' . $this->passed_user->avatar);
        if ($fileExists) {
            Storage::delete('public/' . $this->passed_user->avatar);
        } else {
            //reload the browser because you are trying to delete a file that somehow doesn't exist
            return redirect()->back();
            exit();
        }

        // Start saving the new profile in DB

        //Get The File Name and Extension then Sanitize
        $profile_photo = $this->avatar->getClientOriginalName();

        //Get The Base Name
        $profile_photo_basename = pathinfo($profile_photo, PATHINFO_FILENAME);

        //Get The Extension
        $profile_ext = pathinfo($profile_photo, PATHINFO_EXTENSION);

        //Sanitize the Base Name using Filter Var of FILTER_SANITIZE_STRING then assign back value to orig var
        $profile_photo = filter_var($profile_photo_basename, FILTER_SANITIZE_STRING);

        //Add Unique Identifiers to the Base Name
        $profile_photo = $profile_photo . '-' . uniqid();

        //Merge Back the Extension for the Final File Name
        $profile_photo = $profile_photo . '.' . $profile_ext;

        $this->passed_user->update([
            'avatar' => $this->avatar->storeAs('profile-photos', $profile_photo, 'public'),
        ]);

        $this->dispatch('admin-photo-updated');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Admin Profile Image') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile photo.") }}
        </p>
    </header>

    <form wire:submit="updateProfilePhoto" class="mt-6 space-y-6">




        {{-- SHOW IMAGE PREVIEW UPON UPLOAD --}}
        @if (!is_null($this->avatar) && method_exists($this->avatar, 'temporaryUrl'))
            <div>
                {{-- Image as DIV --}}
                <div class="h-[200px] w-[200px] rounded-full mx-auto border-4 border-gray-500 "
                    style="background-image: url('{{ $this->avatar->temporaryUrl() }}'); background-size: cover; background-position: center">
                </div>
                <p class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Image Preview</p>
            </div>
        @elseif (!is_null($this->passed_user->avatar))
            {{-- SHOW SAVED IMAGE IN DB --}}
            <div>
                {{-- Image as DIV --}}
                <div class="h-[200px] w-[200px] rounded-full mx-auto border-4 border-gray-500 "
                    style="background-image: url('/storage/{{ $this->passed_user->avatar }}'); background-size: cover; background-position: center">
                </div>
                <p class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Profile Photo</p>
            </div>
        @else
            {{-- SHOW DEFAULT IMAGE --}}
            <div>
                {{-- Image as DIV --}}
                <div class="h-[200px] w-[200px] rounded-full mx-auto border-4 border-gray-500 "
                    style="background-image: url('/storage/profile-photos/user-profile-default.jpg'); background-size: cover; background-position: center">
                </div>
                <p class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Profile Default Photo</p>
            </div>
        @endif



        {{-- PROFILE / IMAGE  --}}
        <div>
            <x-input-label for="avatar" :value="__('COURSE COVER PHOTO')" class="uppercase" />
            <x-text-input wire:model="avatar" id="avatar" name="avatar" accept="image/*" class="block w-full mt-1"
                type="file" required />
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="avatar">Accepts
                JPEG, JPG, WEBP or PNG (Max. 4MB)
            </p>
            <p wire:loading wire:target="avatar" class="mt-1 text-xs text-gray-500 dark:text-gray-300">
                Uploading...</p>
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>



        <div class="flex items-center gap-4">
            <x-buttons.primary-button wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="updateProfilePhoto">
                    {{ __('Save') }}
                </span>

                <span wire:loading wire:target="updateProfilePhoto">
                    <x-svgs.spinner size="5" />
                </span>

            </x-buttons.primary-button>

            <x-action-message class="me-3" on="admin-photo-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>

    </form>

</section>
