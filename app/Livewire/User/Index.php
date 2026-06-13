<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;

    public $userId;
    public $email;
    public $password;
    public $name;
    public $role;
    public $nip;
    public $phone;
    public $address;
    public $showModal;
    public $isEdit = false;

    public $search = '';

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => $this->userId
                ? 'nullable|min:6'
                : 'required|min:6',

            'nip' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',

            'role' => 'required',
        ];
    }

    public function store()
    {
        $this->validate();
        $this->showModal = false;

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),

            'nip' => $this->nip,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        $user->assignRole($this->role);
        // $this->showModal(false);

        session()->flash(
            'success',
            'Pengguna berhasil ditambahkan.'
        );

        $this->resetForm();
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->userId = $user->id;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->nip = $user->nip;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->role = $user->roles->first()?->name;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);

        $user->update([
            // 'name' => $this->name,
            'nip' => $this->nip,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'address' => $this->address,
        ]);

        session()->flash('success', 'Data pengguna berhasil diperbarui');

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        user::findOrFail($id)->delete();

        session()->flash('success', 'Pengguna berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->reset([
            'userId',
            'nip',
            'role',
            'email',
            'name',
            'phone',
            'address'
        ]);
        $this->isEdit = true;
    }

    public function render()
    {
        return view('livewire.user.index', [
            // 'users' => User::latest()->paginate(10),
            'users' => User::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('nip', 'like', '%' . $this->search . '%');
                })
                ->latest()
                ->paginate(10),

            'roles' => Role::all(),
        ]);
    }
}
