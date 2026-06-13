<?php

namespace App\Livewire\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class Assign extends Component
{

    public $roleId;

    public $permissions = [];


    public function updatedRoleId()
    {

        $role = Role::find($this->roleId);


        if($role){

            $this->permissions =
                $role->permissions
                ->pluck('name')
                ->toArray();

        }

    }



    public function save()
    {


        $role = Role::findOrFail(
            $this->roleId
        );


        $role->syncPermissions(
            $this->permissions
        );


        session()->flash(
            'success',
            'Permission berhasil diperbarui.'
        );


    }



    public function render()
    {

        return view(
            'livewire.permission.assign',
            [

                'roles'
                =>
                Role::all(),


                'allPermissions'
                =>
                Permission::all(),

            ]

        )->layout('layouts.app');

    }

}
