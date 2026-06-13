<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-blue-600 to-cyan-500">

    <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-8">

        {{-- Logo --}}
        <div class="text-center mb-8">

            <div class="mx-auto w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center">

                <span class="text-4xl">
                    🎓
                </span>

            </div>


            <h1 class="text-3xl font-bold mt-4 text-gray-800">
                Sistem Absensi
            </h1>

            <p class="text-gray-500 mt-2">
                Silahkan login untuk masuk
            </p>

        </div>


        <x-auth-session-status
            class="mb-4"
            :status="session('status')"
        />


        <form method="POST" action="{{ route('login') }}">

            @csrf


            <div>

                <label class="text-sm font-semibold">
                    Email
                </label>


                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="mt-2 w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="email@gmail.com"
                >


                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2"
                />

            </div>



            <div class="mt-5">


                <label class="text-sm font-semibold">
                    Password
                </label>


                <input
                    type="password"
                    name="password"
                    required
                    class="mt-2 w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="********"
                >


                <x-input-error
                    :messages="$errors->get('password')"
                    class="mt-2"
                />

            </div>



            <div class="mt-5 flex items-center">

                <input
                    type="checkbox"
                    name="remember"
                    class="rounded text-indigo-600"
                >

                <span class="ml-2 text-sm text-gray-600">
                    Ingat saya
                </span>

            </div>



            <button
                class="mt-6 w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transition">

                Login

            </button>


        </form>


    </div>

</div>


</x-guest-layout>
