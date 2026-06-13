<?php

namespace App\Livewire\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{

    public function render()
    {

        return view('livewire.permission.index',[

            'roles' => Role::with([
                'permissions',
                'users'
            ])->get()

        ])->layout('layouts.app');

    }

}
