<div class="p-6">

    @if (session()->has('success'))
        <div class="mb-5 p-4 rounded-lg bg-green-50 text-green-700 border border-green-200">
            {{ session('success') }}
        </div>
    @endif


    {{-- Header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl shadow-lg p-6 text-white mb-6">

        <div class="flex justify-between items-center">

            <div>
                <div>
                    <h2 class="text-2xl font-bold text-white">
                        Jadwal Pelajaran
                    </h2>
                    <p class="text-sm text-white">
                        Kelola jadwal kelas dan mata pelajaran
                    </p>
                </div>
            </div>
            <button onclick="document.getElementById('createModal').classList.remove('hidden')"
                class="bg-gray-100 hover:bg-gray-200 text-blue-700 px-5 py-2 rounded-lg shadow">

                + Tambah Jadwal

            </button>


        </div>

    </div>



    <!-- Table -->
    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr class="text-gray-600">
                        <th class="px-6 py-3 text-left">
                            No
                        </th>

                        <th class="px-6 py-3 text-left">
                            Kelas
                        </th>

                        <th class="px-6 py-3 text-left">
                            Guru
                        </th>

                        <th class="px-6 py-3 text-left">
                            Mapel
                        </th>

                        <th class="px-6 py-3 text-left">
                            Hari
                        </th>

                        <th class="px-6 py-3 text-left">
                            Jam
                        </th>

                        <th class="px-6 py-3 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>



                <tbody>


                    @forelse($schedules as $schedule)
                        <tr class="border-b hover:bg-gray-50">


                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>


                            <td class="px-6 py-4 font-medium">
                                {{ $schedule->classroom->class_name }}
                            </td>


                            <td class="px-6 py-4">
                                {{ $schedule->teacher->name }}
                            </td>


                            <td class="px-6 py-4">
                                {{ $schedule->subject->subject_name }}
                            </td>


                            <td class="px-6 py-4">

                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">

                                    {{ $schedule->day }}

                                </span>

                            </td>



                            <td class="px-6 py-4">

                                {{ substr($schedule->start_time, 0, 5) }}
                                -
                                {{ substr($schedule->end_time, 0, 5) }}

                            </td>



                            <td class="px-6 py-4 text-center">


                                <button wire:click="edit({{ $schedule->id }})"
                                    onclick="document.getElementById('editModal').classList.remove('hidden')"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg mr-2">

                                    Edit

                                </button>



                                <button wire:click="delete({{ $schedule->id }})" wire:confirm="Yakin hapus jadwal?"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">

                                    Hapus

                                </button>


                            </td>


                        </tr>


                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-6 text-gray-500">

                                Belum ada jadwal

                            </td>

                        </tr>
                    @endforelse


                </tbody>


            </table>


        </div>


    </div>


    <div class="mt-5">

        {{ $schedules->links() }}

    </div>






    <!-- Modal Create -->

    <div id="createModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">


        <div class="bg-white rounded-xl shadow-xl w-full max-w-xl p-6">


            <h2 class="text-xl font-bold mb-5">

                Tambah Jadwal

            </h2>



            <div class="grid grid-cols-2 gap-4">


                <div>

                    <label class="text-sm">
                        Kelas
                    </label>

                    <select wire:model="class_id" class="w-full border rounded-lg p-2">

                        <option value="">
                            Pilih Kelas
                        </option>


                        @foreach ($classrooms as $class)
                            <option value="{{ $class->id }}">

                                {{ $class->class_name }}

                            </option>
                        @endforeach


                    </select>

                </div>




                <div>

                    <label class="text-sm">
                        Guru
                    </label>


                    <select wire:model="user_id" class="w-full border rounded-lg p-2">


                        <option value="">
                            Pilih Guru
                        </option>


                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">

                                {{ $teacher->name }}

                            </option>
                        @endforeach


                    </select>


                </div>





                <div>

                    <label class="text-sm">
                        Mata Pelajaran
                    </label>


                    <select wire:model="subject_id" class="w-full border rounded-lg p-2">


                        <option value="">
                            Pilih Mapel
                        </option>


                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">

                                {{ $subject->subject_name }}

                            </option>
                        @endforeach


                    </select>


                </div>





                <div>

                    <label class="text-sm">
                        Hari
                    </label>


                    <select wire:model="day" class="w-full border rounded-lg p-2">


                        <option value="">
                            Pilih Hari
                        </option>


                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>


                    </select>


                </div>




                <input type="time" wire:model="start_time" class="border rounded-lg p-2">



                <input type="time" wire:model="end_time" class="border rounded-lg p-2">



            </div>




            <div class="flex justify-end gap-3 mt-6">


                <button onclick="document.getElementById('createModal').classList.add('hidden')"
                    class="px-4 py-2 rounded-lg bg-gray-200">

                    Batal

                </button>



                <button wire:click="store" class="px-5 py-2 rounded-lg bg-blue-600 text-white">

                    Simpan

                </button>



            </div>



        </div>


    </div>


</div>
