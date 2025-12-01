<header class="bg-[#D4B3AA] shadow-sm border-b border-gray-200">
    <div class="flex justify-between items-center px-6 py-4">
        <!-- Greeting untuk User -->
        <div>
            <h1 class="text-2xl font-semibold text-white">
                Hello, {{ session('username') }}! 👋
            </h1>
        </div>

        <!-- Logout Button -->
        <div class="flex items-center gap-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="cursor-pointer text-white">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>