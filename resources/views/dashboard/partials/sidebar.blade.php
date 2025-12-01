<aside class="w-64 bg-[#2E4239] text-white min-h-screen">
    <div class="p-6">
        <img src="{{ asset('image/LOGO WHITE.png') }}" alt="">
    </div>
    
    <nav class="mt-6">
        <ul class="space-y-2">
            <!-- Home -->
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-6 py-3 hover:bg-[#1a2a22] transition duration-200">
                    <i class="fas fa-home mr-3"></i>
                    Home
                </a>
            </li>

            <!-- Menu dengan Submenu -->
<li>
    <details class="group">
        <summary class="flex items-center px-6 py-3 hover:bg-[#1a2a22] transition duration-200 cursor-pointer list-none">
            <i class="fas fa-utensils mr-3"></i>
            Menu
            <i class="fas fa-chevron-down ml-auto transform group-open:rotate-180 transition duration-200"></i>
        </summary>
        <ul class="mt-2 ml-4 space-y-1">
            <li>
                <a href="{{ route('dashboard.menu.index') }}?kategori=all" class="flex items-center px-4 py-2 hover:bg-[#1a2a22] transition duration-200">
                    <i class="fas fa-list mr-3 text-sm"></i>
                    Semua Menu
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.menu.index') }}?kategori=Food" class="flex items-center px-4 py-2 hover:bg-[#1a2a22] transition duration-200">
                    <i class="fas fa-utensil-spoon mr-3 text-sm"></i>
                    Makanan
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.menu.index') }}?kategori=Drink" class="flex items-center px-4 py-2 hover:bg-[#1a2a22] transition duration-200">
                    <i class="fas fa-coffee mr-3 text-sm"></i>
                    Minuman
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.menu.index') }}?kategori=Snack" class="flex items-center px-4 py-2 hover:bg-[#1a2a22] transition duration-200">
                    <i class="fas fa-cookie mr-3 text-sm"></i>
                    Snack
                </a>
            </li>
        </ul>
    </details>
</li>

            <!-- Paket -->
            <li><a href="{{ route('dashboard.paket.index') }}" class="flex items-center px-6 py-3 hover:bg-[#1a2a22] transition duration-200"> 
                <i class="fas fa-box mr-3"></i>Paket</a> 
            </li>

            
            <!-- Review -->
<li>
    <a href="{{ route('dashboard.reviews.index') }}" 
       class="flex items-center px-6 py-3 hover:bg-[#1a2a22] transition duration-200">
        <i class="fas fa-star mr-3"></i>
        Review
    </a>
</li>

            <!-- Reservasi -->
            
            <li>
                <a href="{{ route('dashboard.reservasi.index') }}" class="flex items-center px-6 py-3 hover:bg-[#1a2a22] transition duration-200">
                    <i class="fas fa-calendar-alt mr-3"></i>Reservasi</a>
            </li>

            <!-- Ubah Password -->
            <li>
    <a href="{{ route('dashboard.password.change') }}" 
       class="flex items-center px-6 py-3 hover:bg-[#1a2a22] transition duration-200">
        <i class="fas fa-key mr-3"></i>
        Ubah Password
    </a>
</li>
        </ul>
    </nav>
</aside>