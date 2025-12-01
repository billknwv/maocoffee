@php use Illuminate\Support\Facades\Storage; @endphp

<!-- card product -->
<div class="flex items-center gap-8 self-stretch">
    @foreach($menuItems as $menu)
    <div class="flex w-full h-[447.724px] py-9 px-7 flex-col justify-end items-center gap-2 rounded-[16px] relative overflow-hidden">
        <!-- Background Image dengan Overlay -->
        <div class="absolute inset-0 z-0">
            @if($menu->img_menu && Storage::disk('public')->exists($menu->img_menu))
                <img src="{{ asset('storage/' . $menu->img_menu) }}" 
                     alt="{{ $menu->nama_menu }}" 
                     class="w-full h-full object-cover">    
                <!-- Overlay Gradient -->
                <div class="absolute inset-0" style="background: linear-gradient(180deg, rgba(255, 255, 255, 0.00) 25.4%, #011F2B 120.59%);"></div>
            @else
                <!-- Fallback background jika tidak ada gambar -->
                <div class="w-full h-full bg-gradient-to-br from-pink-200 to-purple-200"></div>
                <!-- Overlay Gradient untuk fallback -->
                <div class="absolute inset-0" style="background: linear-gradient(180deg, rgba(255, 255, 255, 0.00) 25.4%, #011F2B 120.59%);"></div>
            @endif
        </div>
        
        <!-- Content di atas background -->
        <div class="relative z-10 flex flex-col justify-center items-center gap-4 w-full">
            <div class="text-white text-center text-[32px] font-semibold leading-[120%] tracking-[0.16px] drop-shadow-md">
                {{ $menu->nama_menu }}
            </div>
            <div class="text-white text-center text-base font-light leading-[120%] tracking-[0.08px] drop-shadow-md">
                {{ Str::limit($menu->deskripsi_menu, 80) }}
            </div>
            <div class="text-white text-[32px] font-semibold leading-[120%] tracking-[0.16px] drop-shadow-md">
                Rp {{ number_format($menu->harga, 0, ',', '.') }}
            </div>
        </div>
    </div>
    @endforeach
    
    <!-- Jika tidak ada data -->
    @if($menuItems->count() == 0)
    <div class="flex w-full h-[447.724px] py-9 px-7 flex-col justify-center items-center gap-2 rounded-[16px] bg-gray-100 relative">
        <div class="text-gray-500 text-center text-lg">Tidak ada menu untuk kategori {{ $kategoriAktif }}</div>
        <a href="{{ route('menu.create-simple') }}" class="text-blue-500 underline mt-2">Tambah menu</a>
    </div>
    @endif
</div>

<!-- navigasi custom -->
@if($totalPages > 1)
<div class="flex items-center justify-center gap-[63.74px] mt-10">
    <!-- Previous Button -->
    <button class="prev-btn cursor-pointer {{ $page <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}" 
            {{ $page <= 1 ? 'disabled' : '' }}>
        <svg xmlns="http://www.w3.org/2000/svg" width="67" height="67" viewBox="0 0 67 67" fill="none">
            <circle cx="33.364" cy="33.364" r="32.866" fill="white" stroke="#D9D9D9" stroke-width="0.995939"/>
            <path d="M44.8191 34.546H25.5831L34.0029 42.9658L33.04 43.9286L22.9727 33.8613L33.04 23.7939L34.0029 24.7568L25.5831 33.1766H44.8191V34.546Z" fill="black" transform="rotate(0 33.364 33.364)"/>
        </svg>
    </button>

    <!-- Progress Indicators -->
    <div class="flex items-center gap-[15.935px]">
        @for($i = 1; $i <= $totalPages; $i++)
            <div class="w-[119.518px] h-[10px] rounded-full {{ $i == $page ? 'bg-[#2E4239]' : 'bg-[#2E4239]/30' }} transition-colors duration-200 cursor-pointer page-indicator" 
                 data-page="{{ $i }}"
                 data-category="{{ $kategoriAktif }}">
            </div>
        @endfor
    </div>

    <!-- Next Button -->
    <button class="next-btn cursor-pointer {{ $page >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' }}" 
            {{ $page >= $totalPages ? 'disabled' : '' }}>
        <svg xmlns="http://www.w3.org/2000/svg" width="67" height="67" viewBox="0 0 67 67" fill="none">
            <circle cx="33.364" cy="33.364" r="32.866" fill="white" stroke="#D9D9D9" stroke-width="0.995939"/>
            <path d="M44.8191 34.546H25.5831L34.0029 42.9658L33.04 43.9286L22.9727 33.8613L33.04 23.7939L34.0029 24.7568L25.5831 33.1766H44.8191V34.546Z" fill="black" transform="rotate(-180 33.364 33.364)"/>
        </svg>
    </button>
</div>
@endif

<!-- JavaScript untuk navigasi -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const pageIndicators = document.querySelectorAll('.page-indicator');
    const currentCategory = '{{ $kategoriAktif }}';

    // Previous button click
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            if ({{ $page }} > 1) {
                loadMenuContent(currentCategory, {{ $page }} - 1);
            }
        });
    }

    // Next button click
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            if ({{ $page }} < {{ $totalPages }}) {
                loadMenuContent(currentCategory, {{ $page }} + 1);
            }
        });
    }

    // Page indicator click
    pageIndicators.forEach(indicator => {
        indicator.addEventListener('click', function() {
            const page = this.getAttribute('data-page');
            const category = this.getAttribute('data-category');
            loadMenuContent(category, parseInt(page));
        });
    });

    function loadMenuContent(category, page) {
        console.log('Loading content for:', category, page);
        
        // Show loading state
        const menuContent = document.querySelector('#menu-content');
        if (menuContent) {
            menuContent.innerHTML = '<div class="flex justify-center py-10">Loading...</div>';
        }
        
        // AJAX request
        fetch(`/menu-content?category=${category}&page=${page}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(html => {
                if (menuContent) {
                    menuContent.innerHTML = html;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (menuContent) {
                    menuContent.innerHTML = '<div class="flex justify-center py-10 text-red-500">Error loading content</div>';
                }
            });
    }
});
</script>