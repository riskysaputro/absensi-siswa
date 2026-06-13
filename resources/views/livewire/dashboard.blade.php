<div class="p-6">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl shadow-lg p-6 text-white">

        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-3xl font-bold">
                    Dashboard
                </h1>
            </div>


        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mt-6">


        <div class="bg-white shadow rounded-lg p-5">

            <h2 class="text-gray-500">
                Total Siswa
            </h2>

            <p class="text-3xl font-bold">
                {{ $totalStudent }}
            </p>

        </div>



        <div class="bg-white shadow rounded-lg p-5">

            <h2 class="text-gray-500">
                Total Guru
            </h2>

            <p class="text-3xl font-bold">
                {{ $totalTeacher }}
            </p>

        </div>




        <div class="bg-white shadow rounded-lg p-5">

            <h2 class="text-gray-500">
                Total Kelas
            </h2>

            <p class="text-3xl font-bold">
                {{ $totalClass }}
            </p>

        </div>




        <div class="bg-white shadow rounded-lg p-5">

            <h2 class="text-gray-500">
                Hadir Hari Ini
            </h2>

            <p class="text-3xl font-bold">
                {{ $presentToday }}
            </p>

        </div>



    </div>


</div>
