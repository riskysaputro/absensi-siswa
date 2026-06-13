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
                    Data Mata Pelajaran
                </h2>

                <p class="text-sm">
                    Kelola data mata pelajaran
                </p>
            </div>


            <button wire:click="openModal" class="bg-white text-indigo-600 px-4 py-2 rounded-lg shadow">

                + Tambah

            </button>

        </div>

    </div>

    {{-- Search --}}
    <div class="bg-white shadow rounded-lg p-4 mb-4">

        <input type="text" wire:model.live="search" placeholder="Cari mata pelajaran..."
            class="w-full border rounded px-3 py-2">

    </div>

    {{-- Table --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="min-w-full border-collapse">

            <thead class="bg-gray-100">

                <tr>
                    <th class="border px-4 py-2 text-left">No</th>
                    <th class="border px-4 py-2 text-left">Mata Pelajaran</th>
                    <th class="border px-4 py-2 text-left">Deskripsi</th>
                    <th class="border px-4 py-2 text-left">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($subjects as $subject)
                    <tr>

                        <td class="border px-4 py-2">
                            {{ $subjects->firstItem() + $loop->index }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $subject->subject_name }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $subject->description }}
                        </td>

                        <td class="border px-4 py-2">

                            <div class="flex gap-2">

                                <button wire:click="edit({{ $subject->id }})"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">

                                    Edit

                                </button>

                                <button wire:click="delete({{ $subject->id }})"
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

                            Data mata pelajaran belum tersedia

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

        <div class="p-4">
            {{ $subjects->links() }}
        </div>

    </div>

    {{-- Modal --}}
    @if ($showModal)

        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">

                <h2 class="text-xl font-bold mb-4">

                    {{ $subjectId ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran' }}

                </h2>

                <div class="mb-4">

                    <label class="block mb-2">
                        Nama Mata Pelajaran
                    </label>

                    <input type="text" wire:model="subject_name" class="w-full border rounded px-3 py-2">

                    @error('subject_name')
                        <span class="text-red-500 text-sm">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div class="mb-4">

                    <label class="block mb-2">
                        Deskripsi
                    </label>

                    <textarea wire:model="description" class="w-full border rounded px-3 py-2">
                    </textarea>

                </div>

                <div class="flex justify-end gap-2">

                    <button wire:click="$set('showModal', false)" class="bg-gray-500 text-white px-4 py-2 rounded">

                        Batal

                    </button>

                    @if ($subjectId)
                        <button wire:click="update" class="bg-yellow-500 text-white px-4 py-2 rounded">

                            Update

                        </button>
                    @else
                        <button wire:click="store" class="bg-blue-600 text-white px-4 py-2 rounded">

                            Simpan

                        </button>
                    @endif

                </div>

            </div>

        </div>

    @endif

</div>
