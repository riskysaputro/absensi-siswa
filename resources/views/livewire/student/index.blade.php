<div class="p-6">

    {{-- Alert --}}
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
                    Data Siswa
                </h2>

                <p class="text-sm">
                    Kelola data siswa
                </p>
            </div>


            <button wire:click="openModal" class="bg-white text-indigo-600 px-4 py-2 rounded-lg shadow">

                + Tambah

            </button>

        </div>

    </div>

    {{-- Search --}}
    <div class="bg-white shadow rounded-lg p-4 mb-4">
        <input type="text" wire:model.live="search" placeholder="Cari berdasarkan NIS atau Nama..."
            class="w-full border rounded px-3 py-2">
    </div>

    {{-- Table --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="min-w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">No</th>
                    <th class="border px-4 py-2 text-left">NIS</th>
                    <th class="border px-4 py-2 text-left">Nama</th>
                    <th class="border px-4 py-2 text-left">Kelas</th>
                    <th class="border px-4 py-2 text-left">Telepon</th>
                    <th class="border px-4 py-2 text-left">Gender</th>
                    <th class="border px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td class="border px-4 py-2">
                            {{ $loop->iteration }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $student->nis }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $student->name }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $student->classRoom->class_name ?? '-' }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $student->phone }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $student->gender }}
                        </td>

                        <td class="border px-4 py-2">
                            <div class="flex gap-2">

                                <button wire:click="edit({{ $student->id }})"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">
                                    Edit
                                </button>

                                <button wire:click="delete({{ $student->id }})"
                                    wire:confirm="Yakin ingin menghapus data ini?"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    Hapus
                                </button>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border px-4 py-4 text-center text-gray-500">
                            Data siswa belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        <div class="p-4">
            {{ $students->links() }}
        </div>

    </div>



    {{-- modal buat create siswa --}}
    @if ($showModal)

        <div wire:click.self="closeModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">

            <div class="bg-white rounded-xl shadow-xl w-full max-w-3xl p-6">

                <div class="flex justify-between items-center mb-6">

                    <h2 class="text-xl font-bold">
                        {{ $isEdit ? 'Edit Siswa' : 'Tambah Siswa' }}
                    </h2>

                    <button wire:click="closeModal" class="text-gray-500 hover:text-red-500 text-2xl">

                        ×

                    </button>

                </div>

                <form wire:submit="{{ $isEdit ? 'update' : 'store' }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block mb-1 font-medium">
                                Kelas
                            </label>

                            <select wire:model="class_id" class="w-full border rounded-lg px-3 py-2">

                                <option value="">
                                    Pilih Kelas
                                </option>

                                @foreach ($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}">
                                        {{ $classroom->class_name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('class_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">
                                NIS
                            </label>

                            <input type="text" wire:model="nis" class="w-full border rounded-lg px-3 py-2">

                            @error('nis')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">
                                Nama
                            </label>

                            <input type="text" wire:model="name" class="w-full border rounded-lg px-3 py-2">

                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">
                                No HP
                            </label>

                            <input type="text" wire:model="phone" class="w-full border rounded-lg px-3 py-2">
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">
                                Gender
                            </label>

                            <select wire:model="gender" class="w-full border rounded-lg px-3 py-2">

                                <option value="">
                                    Pilih Gender
                                </option>

                                <option value="Laki-Laki">
                                    Laki-Laki
                                </option>

                                <option value="Perempuan">
                                    Perempuan
                                </option>

                            </select>

                            @error('gender')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md:col-span-2">

                            <label class="block mb-1 font-medium">
                                Alamat
                            </label>

                            <textarea wire:model="address" rows="3" class="w-full border rounded-lg px-3 py-2"></textarea>

                        </div>

                    </div>

                    <div class="flex justify-end gap-2 mt-6">

                        <button type="button" wire:click="closeModal"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">

                            Batal

                        </button>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                            {{ $isEdit ? 'Update' : 'Simpan' }}

                        </button>

                    </div>

                </form>

            </div>

        </div>

    @endif
</div>
