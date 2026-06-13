{{-- <div class="max-w-7xl mx-auto p-6"> --}}
<div">

    @if (session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6 mb-6">

        <h2 class="text-xl font-bold mb-4">
            {{ $teacherId ? 'Edit Guru' : 'Tambah Guru' }}
        </h2>

        <div class="grid md:grid-cols-2 gap-4">

            <div>
                <label class="block mb-1">NIP</label>
                <input type="text" wire:model="nip" class="w-full border rounded px-3 py-2">
                @error('nip')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block mb-1">Nama Guru</label>
                <input type="text" wire:model="name" class="w-full border rounded px-3 py-2">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block mb-1">No HP</label>
                <input type="text" wire:model="phone" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1">Alamat</label>
                <textarea wire:model="address" class="w-full border rounded px-3 py-2"></textarea>
            </div>

        </div>

        <div class="mt-4 flex gap-2">

            @if ($teacherId)
                <button wire:click="update" class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Update
                </button>
            @else
                <button wire:click="store" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            @endif

            <button wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded">
                Reset
            </button>

        </div>

    </div>

    <div class="bg-white shadow rounded-lg p-6">

        <div class="flex justify-between mb-4">

            <h2 class="text-xl font-bold">
                Data Guru
            </h2>

            <input type="text" wire:model.live="search" placeholder="Cari guru..." class="border rounded px-3 py-2">

        </div>

        <table class="w-full border">

            <thead class="bg-gray-100">

                <tr>
                    <th class="border px-3 py-2">NIP</th>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">No HP</th>
                    <th class="border px-3 py-2">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($teachers as $teacher)
                    <tr>

                        <td class="border px-3 py-2">
                            {{ $teacher->nip }}
                        </td>

                        <td class="border px-3 py-2">
                            {{ $teacher->name }}
                        </td>

                        <td class="border px-3 py-2">
                            {{ $teacher->phone }}
                        </td>

                        <td class="border px-3 py-2">

                            <button wire:click="edit({{ $teacher->id }})"
                                class="bg-yellow-500 text-white px-3 py-1 rounded">
                                Edit
                            </button>

                            <button wire:click="delete({{ $teacher->id }})" onclick="return confirm('Hapus guru ini?')"
                                class="bg-red-600 text-white px-3 py-1 rounded">
                                Hapus
                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center py-4">
                            Data guru belum ada
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

        <div class="mt-4">
            {{ $teachers->links() }}
        </div>

    </div>

    </div>
