<aside class="fixed top-16 left-0 z-30 w-64 h-[calc(100vh-4rem)] bg-white border-r">

    <ul class="space-y-1 px-3">


        <li>
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100">

                Dashboard

            </a>
        </li>



        {{-- ABSENSI --}}
        @can('manage attendance')
            <li>

                <a href="{{ route('attendance.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">

                    Absensi

                </a>

            </li>
        @endcan




        {{-- LAPORAN --}}
        @can('view report')
            <li>

                <a href="{{ route('attendance.report') }}" class="block px-3 py-2 rounded hover:bg-gray-100">

                    Laporan

                </a>

            </li>
        @endcan




        {{-- DATA MASTER --}}
        @can('manage classroom')
            <li>

                <a href="{{ route('classrooms.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">

                    Data Kelas

                </a>

            </li>
        @endcan




        @can('manage student')
            <li>

                <a href="{{ route('students.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">

                    Data Siswa

                </a>

            </li>
        @endcan




        @can('manage subject')
            <li>

                <a href="{{ route('subject.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">

                    Mata Pelajaran

                </a>

            </li>
        @endcan




        @can('manage schedule')
            <li>

                <a href="{{ route('schedule.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">

                    Jadwal

                </a>

            </li>
        @endcan




        {{-- USER --}}
        @can('manage user')
            <li>

                <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">

                    Pengguna

                </a>

            </li>
        @endcan





        {{-- PERMISSION --}}
        @can('manage permission')
            <li x-data="{ open: false }">


                <button @click="open=!open" class="flex justify-between w-full px-3 py-2 rounded hover:bg-gray-100">

                    <span>
                        Hak Akses
                    </span>


                    <svg class="w-4 h-4" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

                    </svg>


                </button>



                <ul x-show="open" x-transition class="mt-1">


                    <li>

                        <a href="{{ route('permissions.index') }}" class="block pl-8 px-3 py-2 rounded hover:bg-gray-100">

                            Daftar Hak Akses

                        </a>

                    </li>


                    <li>

                        <a href="{{ route('permission.assign') }}" class="block pl-8 px-3 py-2 rounded hover:bg-gray-100">

                            Beri Hak Akses

                        </a>

                    </li>


                </ul>


            </li>
        @endcan



    </ul>


</aside>
