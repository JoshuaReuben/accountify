<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{-- START - BREADCRUMBS --}}
            <x-admin-breadcrumbs />
            {{-- END - BREADCRUMBS --}}
        </h2>
    </x-slot>

    {{-- Sweet Alert --}}
    <x-alerts.sweet-alert-2 on="admin-updated" message="Admin Role Updated Successfully" />
    <x-alerts.sweet-alert-2 on="admin-deleted" message="Admin Deleted Successfully" />


    {{-- START - SECTION 1 - CREATE ADMIN --}}
    <div class="pt-12 py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}
                    <h1 class="my-4 text-xl font-bold uppercase"> CREATE NEW ADMIN</h1>


                    <form wire:submit.prevent="storeANewAdmin" class="mt-6 space-y-6">
                        {{-- ADMIN NAME --}}
                        <div>
                            <x-input-label for="name" :value="__('Admin Name')" class="uppercase" />
                            <x-text-input wire:model="name" id="name" name="name" type="text"
                                class="block w-full mt-1" required autofocus minLength="3" maxLength="150" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        {{-- ADMIN EMAIL --}}
                        <div>
                            <x-input-label for="email" :value="__('Admin Email')" class="uppercase" />
                            <x-text-input wire:model="email" id="email" name="email" type="email"
                                class="block w-full mt-1" required autofocus minLength="3" maxLength="150" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>



                        {{-- ADMIN ROLE --}}
                        <div>
                            <x-input-label for="role" :value="__('Admin Role')" class="mb-2 uppercase" />

                            <select id="role" wire:model="role" name="role" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" selected>Choose Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Super Admin">Super Admin</option>
                            </select>

                            <x-input-error class="mt-2" :messages="$errors->get('role')" />
                        </div>


                        {{-- REGISTER NEW ADMIN --}}
                        <div wire:target=" storeANewAdmin" class="flex items-center gap-4">
                            <x-buttons.primary-button wire:loading.attr="disabled" wire:target=" storeANewAdmin"
                                wire:loading.class="opacity-50 cursor-not-allowed">{{ __('REGISTER') }}</x-buttons.primary-button>

                            {{-- Indicator - loading --}}
                            <div>
                                <div wire:loading wire:target="storeANewAdmin">
                                    <div class="flex items-center">
                                        <div role="status">
                                            <svg aria-hidden="true"
                                                class="w-6 h-6 text-gray-200 me-2 animate-spin dark:text-gray-700 fill-gray-600"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>
                                        </div>
                                        Registering...
                                    </div>
                                </div>
                            </div>

                            <x-action-message class="inline-block" on="admin-added" timeout="5000">
                                {{ __('Admin Created and has been notified to his/her email.') }}
                            </x-action-message>
                        </div>




                    </form>


                    {{-- END SECTION --}}
                </div>
            </div>
        </div>
    </div>
    {{-- END - SECTION 1 - CREATE ADMIN --}}


    {{-- START - SECTION 2 - TABLE --}}
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}
                    <h1 class="my-4 text-xl font-bold uppercase"> CREATED ADMINS</h1>

                    <div
                        class="overflow-hidden w-full overflow-x-auto rounded-xl border border-slate-300 dark:border-slate-700">
                        <table class="w-full text-left text-sm text-slate-700 dark:text-slate-300">
                            <thead
                                class="border-b border-slate-300 bg-slate-100 text-sm text-black dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                                <tr>
                                    <th scope="col" class="p-4">User</th>
                                    <th scope="col" class="p-4">Joined Since</th>
                                    <th scope="col" class="p-4">Role</th>
                                    <th scope="col" class="p-4">Action</th>
                                </tr>
                            </thead>
                            <tbody x-data="{ mode: 'view', adminID: '' }" x-on:admin-updated.window="adminID = ''"
                                class="divide-y divide-slate-300 dark:divide-slate-700">

                                @foreach ($admins as $admin)
                                    <tr>
                                        {{-- User --}}
                                        <td class="p-4">
                                            <div class="flex w-max items-center gap-2">
                                                {{-- Profile --}}
                                                <img class="size-10 rounded-full object-cover"
                                                    src="/storage/{{ $admin->avatar }}" alt="Admin Avatar" />

                                                {{-- Name And Email --}}
                                                <div class="flex flex-col">
                                                    <span class="text-black dark:text-white">{{ $admin->name }}</span>
                                                    <span class="text-sm text-slate-700 opacity-85 dark:text-slate-300">
                                                        {{ $admin->email }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Joined - Date --}}
                                        <td class="p-4">{{ $admin->created_at->format('Y-m-d') }}</td>

                                        <td class="p-4">
                                            <div x-show="adminID != {{ $admin->id }}">
                                                {{-- Display Badge of Admin --}}
                                                @if ($admin->role == 'Admin')
                                                    <span
                                                        class="rounded-xl w-fit border border-blue-700 bg-blue-700 px-2 py-1 text-xs font-medium text-slate-100 dark:border-blue-600 dark:bg-blue-600 dark:text-slate-100">
                                                        Admin
                                                    </span>
                                                @elseif ($admin->role == 'Super Admin')
                                                    <span
                                                        class="rounded-xl w-fit border border-sky-600 bg-sky-600 px-2 py-1 text-xs font-medium text-white dark:border-sky-600 dark:bg-sky-600 dark:text-white">Super
                                                        Admin
                                                    </span>
                                                @endif


                                            </div>


                                            {{-- EDIT ADMIN ROLE --}}
                                            <div x-show="adminID == {{ $admin->id }}">
                                                <select id="EDIT_role.{{ $admin->id }}"
                                                    wire:model="EDIT_role.{{ $admin->id }}"
                                                    name="EDIT_role.{{ $admin->id }}" required
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="">Change Role</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Super Admin">Super Admin</option>
                                                </select>

                                                <x-input-error class="mt-2" :messages="$errors->get('EDIT_role.' . $admin->id)" />
                                            </div>

                                        </td>
                                        {{-- Don't Show if it is you --}}
                                        @if (!($admin->id == Auth::guard('admin')->user()->id))
                                            <td class="p-4">
                                                {{-- VIEW - Actions --}}
                                                <div x-show="adminID != {{ $admin->id }}">
                                                    {{-- Edit Button --}}
                                                    <button type="button"
                                                        @click="mode = 'edit', adminID = {{ $admin->id }}"
                                                        class="cursor-pointer whitespace-nowrap rounded-xl bg-transparent p-0.5 font-semibold text-blue-700 outline-blue-700 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 dark:text-blue-600 dark:outline-blue-600 hover:underline">
                                                        Edit Role
                                                    </button>
                                                    <span> | </span>
                                                    {{-- Delete Button --}}
                                                    <button type="button"
                                                        wire:confirm="Are you sure you want to delete Admin {{ $admin->name }}?"
                                                        wire:click="deleteAdmin({{ $admin->id }})"
                                                        class="cursor-pointer whitespace-nowrap rounded-xl bg-transparent p-0.5 font-semibold text-red-700 outline-red-700 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 dark:text-red-600 dark:outline-red-600 hover:underline">
                                                        Delete
                                                    </button>
                                                </div>

                                                {{-- Save and Cancel - of Edit Mode --}}
                                                <div x-show="mode == 'edit' && adminID == {{ $admin->id }}"
                                                    wire:target="updateARole({{ $admin->id }})"
                                                    class="flex items-center">
                                                    <x-buttons.primary-button type="button"
                                                        wire:click="updateARole({{ $admin->id }})"
                                                        wire:loading.attr="disabled"
                                                        wire:loading.class="opacity-50 cursor-not-allowed">
                                                        {{ __('Save') }}
                                                    </x-buttons.primary-button>

                                                    <x-buttons.secondary-button class="mx-2" type="button"
                                                        wire:click="cancelEditRole({{ $admin->id }})"
                                                        @click="mode = 'view' ,adminID = ''">
                                                        Cancel
                                                    </x-buttons.secondary-button>
                                                </div>
                                            </td>
                                        @else
                                            <td class="p-4 text-sm">
                                                Logged In
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>


                    {{-- END SECTION --}}


                    {{-- ---------------------- --}}
                </div>
            </div>
        </div>
    </div>
    {{-- END - SECTION 2 - TABLE --}}
</div>
