<?php

namespace App\View\Components;


use App\Livewire\Actions\Logout;
use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{

    public function logout(Logout $logout)
    {
        $logout();

        return redirect('/');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('layouts.admin');
    }
}
