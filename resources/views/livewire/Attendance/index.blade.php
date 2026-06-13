<div class="p-6">
    <div class="bg-white rounded-lg shadow p-5">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-lg p-6 text-white">

            <div class="flex justify-between items-center">

                <div>
                    <h1 class="text-3xl font-bold">
                        Absensi Siswa
                    </h1>

                    <p class="text-blue-100 mt-1">
                        Kelola kehadiran siswa berdasarkan jadwal mengajar
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-sm text-blue-100">
                        Tanggal
                    </p>

                    <p class="font-semibold">
                        {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}
                    </p>
                </div>

            </div>

        </div>
        <div class="bg-white rounded-2xl shadow mt-6 p-6">

            <div class="grid md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Jadwal Mengajar
                    </label>

                    <select wire:model.live="scheduleId" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih Jadwal
                        </option>

                        @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}">
                                {{ $schedule->classroom->class_name }}
                                -
                                {{ $schedule->subject->subject_name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Tanggal
                    </label>

                    <input type="date" wire:model.live="date" class="w-full rounded-xl border-gray-300">
                </div>

                <div class="flex items-end gap-3">

                    <button wire:click="markAllPresent"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl">
                        ✓ Semua Hadir
                    </button>

                    <button wire:click="save" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl">
                        Simpan
                    </button>

                </div>

            </div>

        </div>

        {{-- Search --}}
        <div class="bg-white rounded-2xl shadow mt-4 p-4">

            <input type="text" wire:model.live.debounce.300ms="search" placeholder="🔍 Cari NIS atau Nama Siswa..."
                class="w-full rounded-xl border-gray-300">

        </div>
        {{-- Statistik --}}
        <div class="grid grid-cols-4 gap-4 my-6">

            <div class="bg-green-100 rounded-xl p-4">
                <h4 class="text-green-700 font-semibold">
                    Hadir
                </h4>

                <p class="text-2xl font-bold">
                    {{ collect($attendanceData)->where('status', 'Hadir')->count() }}
                </p>
            </div>

            <div class="bg-blue-100 rounded-xl p-4">
                <h4 class="text-blue-700 font-semibold">
                    Izin
                </h4>

                <p class="text-2xl font-bold">
                    {{ collect($attendanceData)->where('status', 'Izin')->count() }}
                </p>
            </div>

            <div class="bg-yellow-100 rounded-xl p-4">
                <h4 class="text-yellow-700 font-semibold">
                    Sakit
                </h4>

                <p class="text-2xl font-bold">
                    {{ collect($attendanceData)->where('status', 'Sakit')->count() }}
                </p>
            </div>

            <div class="bg-red-100 rounded-xl p-4">
                <h4 class="text-red-700 font-semibold">
                    Alpa
                </h4>

                <p class="text-2xl font-bold">
                    {{ collect($attendanceData)->where('status', 'Alpa')->count() }}
                </p>
            </div>

        </div>

        {{-- Alert --}}
        @if (session()->has('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white rounded-2xl shadow mt-6 overflow-hidden">

            <table class="w-full">

                <thead class="bg-slate-800 text-white">

                    <tr>
                        <th class="p-4 text-left">#</th>
                        <th class="p-4 text-left">NIS</th>
                        <th class="p-4 text-left">Nama</th>
                        <th class="p-4 text-left">Status</th>
                        <th class="p-4 text-left">Catatan</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($students as $index => $student)
                        <tr class="border-b hover:bg-slate-50">

                            <td class="p-4">
                                {{ $index + 1 }}
                            </td>

                            <td class="p-4 font-medium">
                                {{ $student->nis }}
                            </td>

                            <td class="p-4">
                                {{ $student->name }}
                            </td>

                            <td class="p-4">

                                <select wire:model="attendanceData.{{ $student->id }}.status"
                                    class="rounded-xl border-gray-300">

                                    <option value="">Status Kehadiran</option>
                                    <option value="Hadir">🟢 Hadir</option>
                                    <option value="Izin">🔵 Izin</option>
                                    <option value="Sakit">🟡 Sakit</option>
                                    <option value="Alpa">🔴 Alpa</option>

                                </select>

                            </td>

                            <td class="p-4">

                                <textarea type="text" wire:model="attendanceData.{{ $student->id }}.note"
                                    class="w-full rounded-xl border-gray-300" placeholder="Catatan"></textarea>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="p-10 text-center text-gray-500">
                                Pilih jadwal terlebih dahulu
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
