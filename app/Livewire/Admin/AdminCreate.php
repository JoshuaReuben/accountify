<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Mail\SendPasswordMail;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;

#[Layout('layouts.admin')]
class AdminCreate extends Component
{

    public $name;
    public $email;
    public $role;
    public $avatar = 'profile-photos/admin-profile-default.jpg';

    public $admins;

    public $EDIT_role;
    public $EDIT_COPY_role;

    public function mount()
    {
        $this->admins = Admin::all();

        foreach ($this->admins as $admin) {
            $this->EDIT_role[$admin->id] = $admin->role;
        }
        $this->EDIT_COPY_role = $this->EDIT_role;
    }

    protected $rules = [
        'name' => ['required', 'string', 'min:3', 'max:150'],
        'email' => ['required', 'string', 'email', 'min:3', 'max:150', 'unique:admins'],
        'role' => ['required', 'string', 'in:Admin,Super Admin'],
    ];

    protected $messages = [
        'name.required' => 'Please enter the name.',
        'name.min' => 'Name should not be less than 3 characters.',
        'name.max' => 'Name should not be more than 150 characters.',
        'email.required' => 'Please enter the email.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'Email already exists.',
        'email.min' => 'Email should not be less than 3 characters.',
        'email.max' => 'Email should not be more than 150 characters.',
        'role.required' => 'Please enter the role.',
        'role.in' => 'Please select a valid role.',
    ];

    public function storeANewAdmin()
    {
        $this->validate();

        //Prepare a temporary password for the Admin user
        $password = Str::random(16);

        $newAdmin = Admin::create([
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'password' => Hash::make($password),
            'role' => $this->role,
        ]);

        Mail::to($newAdmin)->send(new SendPasswordMail($password));
        $this->dispatch('admin-added');
    }


    public function cancelEditRole()
    {
        // Reset The Variables Only
        $this->EDIT_role = $this->EDIT_COPY_role;
    }


    public function updateARole($adminID)
    {
        $admin = Admin::find($adminID);

        $this->validate([
            'EDIT_role.*' => ['required', 'string', 'in:Admin,Super Admin'],
        ], [
            'EDIT_role.*.required' => 'Please enter a role.',
            'EDIT_role.*.in' => 'Please select a valid role.',
        ]);

        $admin->update([
            'role' => $this->EDIT_role[$adminID],
        ]);

        $this->dispatch('admin-updated');
    }

    #[On('admin-added')]
    #[On('admin-updated')]
    public function remount_vars()
    {
        $this->admins = Admin::all();

        foreach ($this->admins as $admin) {
            $this->EDIT_role[$admin->id] = $admin->role;
        }
        $this->EDIT_COPY_role = $this->EDIT_role;
    }

    public function deleteAdmin($adminID)
    {

        try {
            $admin = Admin::find($adminID);
            if ($admin) {
                $admin->delete();
                // Dispatch an event to notify that the admin has been deleted
                $this->dispatch('admin-deleted');
            } else {
                // Dispatch an event if the admin was not found
                $this->dispatch('reload-page');
            }
        } catch (\Exception $e) {
            $this->dispatch('reload-page');
        }
    }

    #[On('admin-deleted')]
    public function render()
    {
        return view('livewire.admin.admin-create');
    }
}
