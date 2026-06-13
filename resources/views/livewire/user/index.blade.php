<div class="p-6">

    @if (session()->has('success'))
        <div class="mb-4 rounded bg-green-100 border border-green-400 text-green-700 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl shadow-lg p-6 text-white mb-6">

        <div class="flex justify-between items-center">

            <div>
                <h2 class="text-2xl font-bold">
                    Data Pengguna
                </h2>

                <p class="text-sm">
                    Kelola data pengguna
                </p>
            </div>


            <button wire:click="openModal" class="bg-white text-indigo-600 px-4 py-2 rounded-lg shadow">

                + Tambah pengguna

            </button>

        </div>

    </div>

    {{-- Search --}}
    <div class="bg-white shadow rounded-lg p-4 mb-4">

        <input type="text" wire:model.live="search" placeholder="Cari pengguna..."
            class="w-full border rounded px-3 py-2">

    </div>

    {{-- Table --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="min-w-full border-collapse">

            <thead class="bg-gray-100">

                <tr>
                    <th class="border px-4 py-2 text-left">No</th>
                    <th class="border px-4 py-2 text-left">Nama</th>
                    <th class="border px-4 py-2 text-left">Email</th>
                    <th class="border px-4 py-2 text-left">Nip</th>
                    <th class="border px-4 py-2 text-left">Role</th>
                    <th class="border px-4 py-2 text-left">Phone</th>
                    <th class="border px-4 py-2 text-left">Address</th>
                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)
                    <tr>

                        <td class="border px-4 py-2">
                            {{ $users->firstItem() + $loop->index }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $user->name }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $user->email }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ $user->nip }}
                        </td>
                        <td class="mx-auto px-2 w-20">
                            @foreach ($user->roles as $role)
                                <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">

                                    {{ $role->name }}

                                </span>
                            @endforeach
                        </td>
                        <td class="border px-4 py-2">
                            {{ $user->phone }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ $user->address }}
                        </td>

                        <td class="border px-4 py-2">

                            <div class="flex gap-2">

                                <button wire:click="edit({{ $user->id }})"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">

                                    Edit

                                </button>

                                <button wire:click="delete({{ $user->id }})"
                                    wire:confirm="Yakin ingin menghapus data ini?"
                                    class="bg-red-600 text-white px-3 py-1 rounded">

                                    Hapus

                                </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="border px-4 py-4 text-center text-gray-500">

                            Data pengguna belum tersedia

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

        {{-- <div class="p-4">
            {{ $user->links() }}
        </div> --}}

    </div>

    {{-- Modal --}}
    @if ($showModal)
        <div wire:click.self="closeModal" <div
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
                <div class="flex justify-between items-center mb-6">

                    <h2 class="text-xl font-bold mb-4">

                        {{ $userId ? 'Edit User' : 'Tambah User' }}

                    </h2>

                    <button wire:click="closeModal" class="text-gray-500 hover:text-red-500 text-2xl">

                        ×

                    </button>
                </div>
                <form wire:submit="{{ $isEdit ? 'update' : 'store' }}">

                    <form class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block mb-1 font-medium">
                                Nama
                            </label>

                            <input type="text" wire:model="name" class="w-full border rounded px-3 py-2">

                            @error('name')
                                <span class="text-red-500 text-sm">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div>
                            <label class="block mb-1 font-medium">
                                Email
                            </label>

                            <input type="text" wire:model="email" class="w-full border rounded px-3 py-2">

                            @error('email')
                                <span class="text-red-500 text-sm">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div>
                            <label class="block mb-1 font-medium">
                                Password
                            </label>

                            <input type="password" wire:model="password" class="w-full border rounded px-3 py-2">

                            @error('password')
                                <span class="text-red-500 text-sm">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div>
                            <label class="block mb-1 font-medium">
                                Role
                            </label>

                            <select wire:model="role">
                                <option value="">Pilih Role</option>

                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div>
                            <label class="block mb-1 font-medium">
                                Nip
                            </label>

                            <input type="text" wire:model="nip" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block mb-1 font-medium">
                                Phone
                            </label>

                            <input type="text" wire:model="phone" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block mb-1 font-medium">
                                Address
                            </label>

                            <textarea wire:model="address" class="w-full border rounded px-3 py-2">
                    </textarea>

                        </div>

                        <div class="flex justify-end gap-2">

                            <button wire:click="$set('showModal', false)"
                                class="bg-gray-500 text-white px-4 py-2 rounded">

                                Batal

                            </button>

                            @if ($userId)
                                <button wire:click="update" class="bg-yellow-500 text-white px-4 py-2 rounded">

                                    Update

                                </button>
                            @else
                                <button wire:click="store" class="bg-blue-600 text-white px-4 py-2 rounded">

                                    Simpan

                                </button>
                            @endif

                        </div>
                    </form>
            </div>

        </div>

    @endif

</div>
