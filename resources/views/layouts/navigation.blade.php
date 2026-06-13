<nav class="bg-white shadow border-b">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between h-16 items-center">


            <div class="flex items-center gap-8">


                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-indigo-600">

                    🎓 AbsensiKu

                </a>



                <div class="hidden md:flex gap-5">


                    <a href="{{ route('dashboard') }}" class="hover:text-indigo-600">

                        Dashboard

                    </a>



                    @can('manage student')
                        <a href="{{ route('students.index') }}" class="hover:text-indigo-600">

                            Siswa

                        </a>
                    @endcan



                    @can('manage attendance')
                        <a href="{{ route('attendance.index') }}" class="hover:text-indigo-600">

                            Absensi

                        </a>
                    @endcan



                    <a href="{{ route('attendance.report') }}" class="hover:text-indigo-600">

                        Rekap Laporan

                    </a>


                    @role('Super Admin')
                        <a href="{{ route('permissions.index') }}" class="hover:text-indigo-600">

                            Hak Akses

                        </a>
                    @endrole



                </div>


            </div>



            <div class="flex items-center gap-4">


                <div class="text-right">

                    <p class="font-semibold">

                        {{ auth()->user()->name }}

                    </p>


                    <span class="text-xs text-gray-500">

                        {{ auth()->user()->getRoleNames()->first() }}

                    </span>


                </div>




                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button class="bg-red-500 text-white px-4 py-2 rounded-xl">

                        Logout

                    </button>


                </form>


            </div>



        </div>

    </div>


</nav>
