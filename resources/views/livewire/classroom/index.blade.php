<div class="p-6">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl shadow-lg p-6 text-white mb-6">

        <div class="flex justify-between items-center">

            <div>
                <h2 class="text-2xl font-bold">
                    Data Kelas
                </h2>

                <p class="text-sm">
                    Kelola data kelas siswa
                </p>
            </div>


            <button wire:click="openCreate" class="bg-white text-indigo-600 px-4 py-2 rounded-lg shadow">
                + Tambah
            </button>

        </div>

    </div>


    {{-- Alert --}}
    @if (session()->has('success'))
        <div class="mb-5 p-4 rounded-lg bg-green-50 text-green-700 border">

            {{ session('success') }}

        </div>
    @endif



    {{-- Table --}}
    <div class="bg-white rounded-xl shadow border overflow-hidden">


        <table class="w-full text-sm">

            <thead class="bg-gray-50 border-b">

                <tr>

                    <th class="px-5 py-3 text-left">
                        Nama Kelas
                    </th>

                    <th class="px-5 py-3 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($classrooms as $classroom)
                    <tr class="border-b hover:bg-gray-50">


                        <td class="px-5 py-3 font-medium">

                            {{ $classroom->class_name }}

                        </td>


                        <td class="px-5 py-3">


                            <div class="flex justify-center gap-2">


                                <button wire:click="openEdit({{ $classroom->id }})"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">

                                    Edit

                                </button>


                                <button wire:click="delete({{ $classroom->id }})" wire:confirm="Yakin hapus data?"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">

                                    Hapus

                                </button>


                            </div>


                        </td>


                    </tr>


                @empty


                    <tr>

                        <td colspan="2" class="text-center py-5 text-gray-500">

                            Belum ada data kelas

                        </td>

                    </tr>
                @endforelse


            </tbody>


        </table>


    </div>






{{-- CREATE MODAL --}}
@if ($showCreateModal)
    <div class="fixed inset-0 bg-black/40 flex items-center justify-center">


        <div class="bg-white rounded-xl p-6 w-96">


            <h2 class="text-xl font-bold mb-4">

                Tambah Kelas

            </h2>



            <form wire:submit.prevent="store">


                <input wire:model="class_name" class="w-full border rounded-lg px-3 py-2" placeholder="Nama kelas">


                <div class="flex justify-end gap-2 mt-5">


                    <button type="button" wire:click="closeCreate" class="bg-gray-400 text-white px-4 py-2 rounded">

                        Batal

                    </button>


                    <button class="bg-blue-600 text-white px-4 py-2 rounded">

                        Simpan

                    </button>


                </div>


            </form>


        </div>


    </div>
@endif






{{-- EDIT MODAL --}}
@if ($showEditModal)
    <div class="fixed inset-0 bg-black/40 flex menampilkan items-center justify-center">


        <div class="bg-white rounded-xl p-6 w-96">


            <h2 class="text-xl font-bold mb-4">

                Edit Kelas

            </h2>



            <form wire:submit.prevent="update">


                <input wire:model="class_name" class="w-full border rounded-lg px-3 py-2">



                <div class="flex justify-end gap-2 mt-5">


                    <button type="button" wire:click="closeEdit" class="bg-gray-400 text-white px-4 py-2 rounded">

                        Batal

                    </button>



                    <button class="bg-yellow-500 text-white px-4 py-2 rounded">

                        Update

                    </button>


                </div>


            </form>


        </div>


    </div>
@endif
