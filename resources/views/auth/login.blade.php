<x-guest-layout>

    <div class="min-h-1/2 flex items-center justify-center bg-white px-4">

        {{-- Card --}}
        <div class="w-full max-w-md">

            {{-- Header --}}
            <div class="text-center mb-8">

                <div
                    class="mx-auto w-20 h-20 rounded-2xl
                    bg-indigo-50 flex items-center justify-center
                    shadow-inner">
                    <span class="text-4xl">
                        🎓
                    </span>
                </div>


                <h1 class="mt-5 text-3xl font-bold text-gray-800">
                    Sistem Absensi
                </h1>


                <p class="mt-2 text-sm text-gray-500">
                    Login untuk mengakses dashboard
                </p>

            </div>



            <x-auth-session-status class="mb-4" :status="session('status')" />



            <form method="POST" action="{{ route('login') }}">

                @csrf



                {{-- Email --}}
                <div>

                    <label class="text-sm font-medium text-gray-700">
                        Email
                    </label>


                    <div class="mt-2">

                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="nama@email.com"
                            class="
                            w-full
                            rounded-xl
                            border-gray-200
                            bg-gray-50
                            px-4
                            py-3
                            text-sm
                            transition

                            focus:bg-white
                            focus:border-indigo-500
                            focus:ring-4
                            focus:ring-indigo-100
                            ">

                    </div>


                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                </div>




                {{-- Password --}}
                <div class="mt-5">


                    <label class="text-sm font-medium text-gray-700">
                        Password
                    </label>



                    <input type="password" name="password" required placeholder="••••••••"
                        class="
                        mt-2
                        w-full
                        rounded-xl
                        border-gray-200
                        bg-gray-50
                        px-4
                        py-3
                        text-sm
                        transition

                        focus:bg-white
                        focus:border-indigo-500
                        focus:ring-4
                        focus:ring-indigo-100
                        ">


                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                </div>




                {{-- Remember --}}
                <div class="mt-5 flex items-center">


                    <input type="checkbox" name="remember"
                        class="
                        rounded
                        border-gray-300
                        text-indigo-600
                        focus:ring-indigo-500
                        ">


                    <span class="ml-2 text-sm text-gray-600">
                        Ingat saya
                    </span>


                </div>




                {{-- Button --}}
                <button
                    class="
                    mt-7
                    w-full

                    bg-indigo-600
                    hover:bg-indigo-700

                    text-white
                    py-3

                    rounded-xl

                    font-semibold

                    shadow-lg
                    shadow-indigo-200

                    transition
                    duration-300

                    hover:-translate-y-0.5
                    ">

                    Masuk

                </button>
            </form>

            <p class="text-center text-xs text-gray-400 mt-6">
                © {{ date('Y') }} Sistem Absensi Siswa
            </p>
        </div>
    </div>
</x-guest-layout>
