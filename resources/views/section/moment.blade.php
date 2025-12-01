<section class="flex w-full min-h-screen p-20 flex-col items-start gap-8">
    <div class="flex w-full justify-between items-start">
        <div class="text-black text-[16px] font-normal w-36 h-[43px]">Your daily partner with flavour</div>
        <div class="text-black font-poppins text-[32px] font-medium leading-normal tracking-[-0.64px] w-[587px] h-[143px] flex-shrink-0">There is always a new moment that we want to create for our customers through the warmth of Mao Coffee</div>
    </div>

    <div class="flex items-stretch gap-14 w-full h-full flex-1 relative" id="cardsContainer">
        <!-- card moment1 -->
        <div class="flex flex-col items-start gap-4 flex-1 transition-all duration-500 ease-in-out card" data-card="1" data-position="left">
            <!-- img card -->
            <div class="flex w-full h-[500px] flex-col items-start gap-2.5 rounded-2xl bg-cover bg-center" style="background-image: url('{{ asset('image/momen1.png') }}');">
                <!-- icon card -->
                <div class="flex p-3 items-center gap-2 rounded-[14px] bg-white m-4">
                    <img src="{{ asset('image/moment-icon.png') }}" alt="" class="w-6 h-6">
                    <div class="font-semibold text-lg">Good Taste</div>
                </div>
            </div>

            <!-- arrow nav - HANYA DI CARD KIRI -->
            <div class="flex items-start gap-4 w-full card-nav">
                <button class="w-16 h-16 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:bg-gray-100 prev-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>
                </button>
                <button class="w-16 h-16 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:bg-gray-100 next-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                </button>
            </div>

            <!-- Content untuk card 1 -->
            <div class="flex flex-col items-start gap-3 w-full flex-1 card-content hidden">
                <div class="w-full text-black font-poppins text-2xl font-medium leading-tight">Experience the Richness</div>
                <div class="w-full text-black font-poppins text-base font-normal leading-relaxed flex-1">Indulge in our carefully crafted coffee blends that awaken your senses and elevate your daily routine with exceptional flavor profiles.</div>
            </div>
        </div>

        <!-- card moment2 -->
        <div class="flex flex-col items-start gap-4 flex-1 transition-all duration-500 ease-in-out card" data-card="2" data-position="middle">
            <div class="flex w-full h-[500px] flex-col items-start gap-2.5 rounded-2xl bg-cover bg-center" style="background-image: url('{{ asset('image/momen2.png') }}');">
                <!-- icon card -->
                <div class="flex p-3 items-center gap-2 rounded-[14px] bg-white m-4">
                    <img src="{{ asset('image/moment-icon.png') }}" alt="" class="w-6 h-6">
                    <div class="font-semibold text-lg">Good Feel</div>
                </div>
            </div>

            <!-- Content untuk card 2 -->
            <div class="flex flex-col items-start gap-3 w-full flex-1 card-content">
                <div class="w-full text-black font-poppins text-2xl font-medium leading-tight">More than a coffee it's mao moments!</div>
                <div class="w-full text-black font-poppins text-base font-normal leading-relaxed flex-1">Whether you're chasing inspiration, unwinding from a busy day, or simply craving something special, Mao Coffee is here to lift your spirits.</div>
            </div>

            <!-- Navigation untuk card 2 (hidden by default) -->
            <div class="flex items-start gap-4 w-full card-nav hidden">
                <button class="w-16 h-16 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:bg-gray-100 prev-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>
                </button>
                <button class="w-16 h-16 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:bg-gray-100 next-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- card moment3 -->
        <div class="flex flex-col items-start gap-4 flex-1 transition-all duration-500 ease-in-out card" data-card="3" data-position="right">
            <div class="flex w-full h-[500px] flex-col items-start gap-2.5 rounded-2xl bg-cover bg-center" style="background-image: url('{{ asset('image/momen3.png') }}');">
                <!-- icon card -->
                <div class="flex p-3 items-center gap-2 rounded-[14px] bg-white m-4">
                    <img src="{{ asset('image/moment-icon.png') }}" alt="" class="w-6 h-6">
                    <div class="font-semibold text-lg">Good Vibes</div>
                </div>
            </div>
            
            <!-- Content untuk card 3 -->
            <div class="flex flex-col items-start gap-3 w-full flex-1 card-content hidden">
                <div class="w-full text-black font-poppins text-2xl font-medium leading-tight">Create your perfect moment</div>
                <div class="w-full text-black font-poppins text-base font-normal leading-relaxed flex-1">Every visit to Mao Coffee is an opportunity to create memories that last a lifetime. Share laughter, stories, and cozy times with us.</div>
            </div>

            <!-- Navigation untuk card 3 (hidden by default) -->
            <div class="flex items-start gap-4 w-full card-nav hidden">
                <button class="w-16 h-16 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:bg-gray-100 prev-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>
                </button>
                <button class="w-16 h-16 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:bg-gray-100 next-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    const prevButtons = document.querySelectorAll('.prev-btn');
    const nextButtons = document.querySelectorAll('.next-btn');
    
    // State awal - urutan dari kiri ke kanan
    let currentState = {
        1: 'left',     // Card 1: posisi kiri dengan navigasi
        2: 'middle',   // Card 2: posisi tengah dengan konten
        3: 'right'     // Card 3: posisi kanan tanpa konten
    };
    
    // Inisialisasi posisi awal
    initializePositions();
    
    // Event listeners untuk semua tombol navigasi
    prevButtons.forEach(btn => {
        btn.addEventListener('click', moveLeft);
    });
    
    nextButtons.forEach(btn => {
        btn.addEventListener('click', moveRight);
    });
    
    function initializePositions() {
        updateCardAppearance();
    }
    
    function moveLeft() {
        console.log('Tombol kiri ditekan');
        
        // Simpan state sebelumnya
        const newState = {...currentState};
        
        // Rotasi posisi ke kiri: 1->3, 2->1, 3->2
        const temp = newState[1];
        newState[1] = newState[2];
        newState[2] = newState[3];
        newState[3] = temp;
        
        currentState = newState;
        updateCardAppearance();
    }
    
    function moveRight() {
        console.log('Tombol kanan ditekan');
        
        // Simpan state sebelumnya
        const newState = {...currentState};
        
        // Rotasi posisi ke kanan: 1->2, 2->3, 3->1
        const temp = newState[3];
        newState[3] = newState[2];
        newState[2] = newState[1];
        newState[1] = temp;
        
        currentState = newState;
        updateCardAppearance();
    }
    
    function updateCardAppearance() {
        console.log('Current state:', currentState);
        
        cards.forEach(card => {
            const cardNumber = card.getAttribute('data-card');
            const position = currentState[cardNumber];
            
            // Update data attribute
            card.setAttribute('data-position', position);
            
            // Reset semua kelas
            card.classList.remove('order-1', 'order-2', 'order-3', 'opacity-50', 'scale-95');
            
            // Atur order dan styling berdasarkan posisi
            switch(position) {
                case 'left':
                    card.classList.add('order-1', 'opacity-50', 'scale-95');
                    // Card di left: sembunyikan konten, TAMPILKAN navigasi
                    card.querySelectorAll('.card-content').forEach(content => {
                        content.classList.add('hidden');
                    });
                    card.querySelectorAll('.card-nav').forEach(nav => {
                        nav.classList.remove('hidden');
                    });
                    break;
                    
                case 'middle':
                    card.classList.add('order-2');
                    // Card di middle: tampilkan konten, SEMBUNYIKAN navigasi
                    card.querySelectorAll('.card-content').forEach(content => {
                        content.classList.remove('hidden');
                    });
                    card.querySelectorAll('.card-nav').forEach(nav => {
                        nav.classList.add('hidden');
                    });
                    break;
                    
                case 'right':
                    card.classList.add('order-3', 'opacity-50', 'scale-95');
                    // Card di right: sembunyikan konten, SEMBUNYIKAN navigasi
                    card.querySelectorAll('.card-content').forEach(content => {
                        content.classList.add('hidden');
                    });
                    card.querySelectorAll('.card-nav').forEach(nav => {
                        nav.classList.add('hidden');
                    });
                    break;
            }
        });
    }
});
</script>