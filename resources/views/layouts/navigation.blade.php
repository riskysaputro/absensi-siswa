<nav class="fixed top-0 w-full z-50 bg-white shadow border-b">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-16 items-center">

            {{-- Logo di kiri --}}
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-xl font-bold text-indigo-600">
                <span class="text-2xl">🎓</span>
                <span>AbsensiKu</span>
            </a>


            {{-- User kanan ama tombol logout dikanan --}}
            <div class="flex items-center gap-6">

                <div class="text-right">
                    <p class="font-semibold text-gray-800">
                        {{ auth()->user()->name }}
                    </p>
                    <span class="text-xs text-gray-500">
                        {{ auth()->user()->getRoleNames()->first() }}
                    </span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="bg-red-500 hover:bg-red-600 transition text-white px-4 py-2 rounded-xl shadow">
                        Logout
                    </button>

                </form>

            </div>

        </div>
    </div>
</nav>
