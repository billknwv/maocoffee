<!-- seluruh content -->
<section class="flex flex-col justify-center items-center w-full flex-shrink-0 relative min-h-screen">
    <!-- Background image di belakang -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('image/adsbg.png') }}" alt="Background" class="w-full h-full object-cover">
    </div>
    
    <div class="flex flex-col justify-between items-start flex-1 self-stretch relative z-10 min-h-screen">
        <!-- gambar atas -->
        <div class="flex flex-col items-end gap-2.5 self-stretch">
            <div class="flex items-end relative">
                <div class="flex items-center gap-[7.425px] w-[215.325px] h-[215.325px] bg-[#D4B3AA] absolute -left-10 -bottom-10 z-10"></div>
                <div class="flex items-center gap-[7.425px] pb-[22.275px] relative z-20"><img src="{{ asset('image/ads1.png') }}" alt=""></div>
            </div>
        </div>

        <!-- konten tengah (dibuat invisible tapi tetap ada di DOM) -->
        <div class="flex-1 flex flex-col justify-center items-center gap-2.5 self-stretch invisible">
            <div class="flex items-start space-x-0 [&>*:last-child]:translate-x-[-453px]">
                <div class="flex flex-col items-start gap-5 w-[904px]">
                    <!-- Teks COFFEE -->
                    <div class="flex flex-col justify-center self-stretch h-[183px] text-[#2E4239] [text-shadow:0_4px_4px_rgba(0,0,0,0.25)] font-sora text-[227.623px] font-bold leading-normal opacity-0">COFFEE</div>
                    <!-- Deskripsi -->
                    <div class="w-[418px] text-black font-poppins text-[16px] font-normal leading-normal opacity-0">We're a coffee brand that moves with the flow of today, staying fresh, creative, and always in touch with what our customers love most.</div>
                </div>
                <div class="flex justify-center items-center gap-2.5 pt-[218px] px-2.5">
                    <!-- Teks MAO -->
                    <div class="flex flex-col justify-center w-[637px] h-[173px] text-[#2E4239] [text-shadow:0_4px_4px_rgba(0,0,0,0.25)] font-sora text-[227.623px] font-bold leading-normal opacity-0">MAO</div>
                </div>
            </div>
            
            <!-- Botol dan splash (tetap invisible) -->
            <div class="absolute top-[40%] left-[71%] transform -translate-x-1/2 -translate-y-1/2 z-30 -rotate-[15deg] opacity-0">
                <img src="{{ asset('image/botol.png') }}" alt="" class="w-[209.083px] h-[473.674px]">
            </div>
            <div class="absolute top-[40%] left-[71%] transform -translate-x-1/2 -translate-y-1/2 z-20 opacity-0">
                <img src="{{ asset('image/splash.png') }}" alt="">
            </div>
        </div>

        <!-- gambar bawah -->
        <div class="flex items-end gap-2.5 self-stretch">
            <div class="flex flex-col items-end space-y-0 [&>*:last-child]:translate-y-[-191.565px]">
                <div class="flex flex-col items-start gap-[7.425px] w-[215.325px] h-[215.325px] bg-[#D4B3AA]"></div>
                <div class="flex items-center gap-[7.425px] pr-[22.275px] self-stretch"><img src="{{ asset('image/ads2.png') }}" alt=""></div>
            </div>
        </div>
    </div>
</section>