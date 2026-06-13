<div class="p-6">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl shadow-lg p-6 text-white">

        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-3xl font-bold">
                    Rekap Absensi
                </h1>

                <p class="text-indigo-100 mt-1">
                    Monitoring kehadiran siswa berdasarkan data absensi
                </p>
            </div>

            <div class="text-right flex items-center gap-3">


                <a href="{{ route('attendance.report.pdf', [
                    'classId' => $classId,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                ]) }}"
                    target="_blank" class="bg-white text-indigo-600 px-4 py-2 rounded-xl font-semibold shadow">

                    ⬇ Download PDF

                </a>



                <div>

                    <p class="text-sm text-indigo-100">
                        Total Siswa
                    </p>


                    <p class="text-3xl font-bold">
                        {{ $students->count() }}
                    </p>


                </div>


            </div>

        </div>

    </div>


    <div class="bg-white rounded-2xl shadow mt-6 p-5">

        <div class="grid md:grid-cols-4 gap-4">
            {{-- Search Nama --}}

            <div>

                <label class="block text-sm font-medium mb-2">

                    Cari Siswa

                </label>


                <input type="text" wire:model.live="search" placeholder="Cari nama / NIS..."
                    class="w-full rounded-xl border-gray-300">


            </div>

            {{-- Kelas --}}
            <div>
                <label class="block text-sm font-medium mb-2">
                    Kelas
                </label>

                <select wire:model.live="classId" class="w-full rounded-xl border-gray-300">

                    <option value="">
                        Semua Kelas
                    </option>

                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">
                            {{ $classroom->class_name }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Tanggal Awal --}}
            <div>
                <label class="block text-sm font-medium mb-2">
                    Tanggal Awal
                </label>

                <input type="date" wire:model.live="startDate" class="w-full rounded-xl border-gray-300">
            </div>

            {{-- Tanggal Akhir --}}
            <div>
                <label class="block text-sm font-medium mb-2">
                    Tanggal Akhir
                </label>

                <input type="date" wire:model.live="endDate" class="w-full rounded-xl border-gray-300">
            </div>

        </div>

    </div>

    {{-- Statistik --}}
    <div class="grid md:grid-cols-4 gap-4 mt-6">

        <div class="bg-green-100 rounded-2xl p-5">
            <div class="text-green-700 font-semibold">
                Total Hadir
            </div>

            <div class="text-3xl font-bold">
                {{ $students->sum(fn($s) => $s->attendanceDetails->where('status', 'Hadir')->count()) }}
            </div>
        </div>

        <div class="bg-blue-100 rounded-2xl p-5">
            <div class="text-blue-700 font-semibold">
                Total Izin
            </div>

            <div class="text-3xl font-bold">
                {{ $students->sum(fn($s) => $s->attendanceDetails->where('status', 'Izin')->count()) }}
            </div>
        </div>

        <div class="bg-yellow-100 rounded-2xl p-5">
            <div class="text-yellow-700 font-semibold">
                Total Sakit
            </div>

            <div class="text-3xl font-bold">
                {{ $students->sum(fn($s) => $s->attendanceDetails->where('status', 'Sakit')->count()) }}
            </div>
        </div>

        <div class="bg-red-100 rounded-2xl p-5">
            <div class="text-red-700 font-semibold">
                Total Alfa
            </div>

            <div class="text-3xl font-bold">
                {{ $students->sum(fn($s) => $s->attendanceDetails->where('status', 'Alfa')->count()) }}
            </div>
        </div>

    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl shadow mt-6 overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-800 text-white">

                <tr>
                    <th class="p-4 text-left">NIS</th>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-center">Hadir</th>
                    <th class="p-4 text-center">Izin</th>
                    <th class="p-4 text-center">Sakit</th>
                    <th class="p-4 text-center">Alfa</th>
                </tr>

            </thead>

            <tbody>

                @forelse($students as $student)
                    <tr class="border-b hover:bg-slate-50">

                        <td class="p-4 font-medium">
                            {{ $student->nis }}
                        </td>

                        <td class="p-4">
                            {{ $student->name }}
                        </td>

                        <td class="p-4 text-center">

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold">
                                {{ $student->attendanceDetails->where('status', 'Hadir')->count() }}
                            </span>

                        </td>

                        <td class="p-4 text-center">

                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold">
                                {{ $student->attendanceDetails->where('status', 'Izin')->count() }}
                            </span>

                        </td>

                        <td class="p-4 text-center">

                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                                {{ $student->attendanceDetails->where('status', 'Sakit')->count() }}
                            </span>

                        </td>

                        <td class="p-4 text-center">

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold">
                                {{ $student->attendanceDetails->where('status', 'Alfa')->count() }}
                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-10 text-gray-500">

                            <div class="flex flex-col items-center gap-2">

                                <span class="text-5xl">
                                    📋
                                </span>

                                <span>
                                    Belum ada data rekap absensi
                                </span>

                            </div>

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>
