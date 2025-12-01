<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi - Mao Place</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-[#2E4239] py-4">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-white flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('image/LOGO WHITE.png') }}" alt="Mao Place" class="h-8">
                    <span class="text-white text-xl font-semibold">Reservasi</span>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <form id="reservasiForm" action="{{ route('reservasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Kolom Kiri - Form Reservasi -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Form Data Diri -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Data Reservasi</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap *</label>
                                <input type="text" name="nama_reservasi" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2E4239] focus:border-transparent"
                                       placeholder="Masukkan nama lengkap" required>
                            </div>

                            <!-- No Telepon -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">No Telepon *</label>
                                <input type="tel" name="no_hp" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2E4239] focus:border-transparent"
                                       placeholder="Contoh: 081234567890" required>
                            </div>

                            <!-- Tanggal -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Reservasi *</label>
                                <input type="date" name="tgl_reservasi" id="tgl_reservasi"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2E4239] focus:border-transparent"
                                       min="{{ date('Y-m-d') }}" required>
                            </div>

                            <!-- Jam -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Jam Reservasi *</label>
                                <select name="jam_reservasi" id="jam_reservasi"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2E4239] focus:border-transparent" required>
                                    <option value="">Pilih Jam</option>
                                    @for($i = 9; $i <= 22; $i++)
                                        @php
                                            $jam = str_pad($i, 2, '0', STR_PAD_LEFT);
                                            $jam_end = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                                            $jam_text = $jam . ':00 - ' . $jam_end . ':00';
                                        @endphp
                                        <option value="{{ $jam_text }}">{{ $jam_text }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Card Paket -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Pilih Paket</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="paketContainer">
                            @foreach($pakets as $paket)
                            <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-md transition-shadow duration-300">
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $paket->image_paket) }}" 
                                         alt="{{ $paket->nama_paket }}" 
                                         class="w-full h-48 object-cover rounded-xl">
                                </div>
                                
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $paket->nama_paket }}</h3>
                                <p class="text-gray-600 mb-4">{{ $paket->deeskripsi_menu }}</p>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-[#2E4239]">Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}</span>
                                    
                                    <div class="flex items-center gap-3">
                                        <button type="button" 
                                                class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-300 transition-colors duration-200 minus-btn"
                                                data-paket-id="{{ $paket->id_paket }}">
                                            <i class="fas fa-minus text-xs"></i>
                                        </button>
                                        <span class="w-8 text-center qty-display" data-paket-id="{{ $paket->id_paket }}">0</span>
                                        <button type="button" 
                                                class="w-8 h-8 rounded-full bg-[#2E4239] flex items-center justify-center text-white hover:bg-[#1a2a22] transition-colors duration-200 plus-btn"
                                                data-paket-id="{{ $paket->id_paket }}">
                                            <i class="fas fa-plus text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan - Detail Pesanan -->
                <div class="space-y-8">
                    <!-- Card Detail Pesanan -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sticky top-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Detail Pesanan</h2>
                        
                        <!-- List Pesanan -->
                        <div class="space-y-4 mb-6" id="pesananList">
                            <div class="text-center text-gray-500 py-4" id="emptyPesanan">
                                Belum ada pesanan
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="border-t border-gray-200 pt-4 mb-6">
                            <div class="flex justify-between items-center text-lg font-semibold">
                                <span>Total</span>
                                <span id="totalHarga">Rp 0</span>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Catatan Tambahan</label>
                            <textarea name="catatan" rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2E4239] focus:border-transparent"
                                      placeholder="Contoh: Tidak pakai pedas, meja dekat jendela, dll."></textarea>
                        </div>

                        <!-- Info DP -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
                            <p class="text-sm text-yellow-800 text-center">
                                <i class="fas fa-info-circle mr-1"></i>
                                Setiap pemesanan wajib untuk membayar DP 50%
                            </p>
                        </div>

                        <!-- Upload Bukti -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Upload Bukti Pembayaran *</label>
                            <input type="file" name="bukti_pembayaran" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2E4239] focus:border-transparent"
                                   accept="image/*" required>
                            <p class="text-xs text-gray-500 mt-2">Format: jpeg, png, jpg, gif | Max: 2MB</p>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="border border-gray-200 rounded-xl p-4 mb-6">
                            <h3 class="font-semibold text-gray-800 mb-3">Metode Pembayaran</h3>
                            
                            <!-- QRIS Placeholder -->
                            <div class="bg-gray-100 rounded-xl p-4 text-center mb-4">
                                <div class="w-32 h-32 bg-gray-300 rounded-lg mx-auto mb-2 flex items-center justify-center">
                                    <i class="fas fa-qrcode text-4xl text-gray-500"></i>
                                </div>
                                <p class="text-sm text-gray-600">Scan QRIS untuk pembayaran</p>
                            </div>

                            <!-- Rekening Bank -->
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">BCA</span>
                                    <span class="font-medium">228743924028249</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">BRI</span>
                                    <span class="font-medium">0232U82219313912</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">MANDIRI</span>
                                    <span class="font-medium">247987427947</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Booking -->
                        <button type="submit" 
                                class="w-full bg-[#2E4239] hover:bg-[#1a2a22] text-white py-4 rounded-xl transition duration-200 flex items-center justify-center gap-2 text-lg font-semibold">
                            <i class="fas fa-calendar-check"></i>
                            Booking Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Data paket dari PHP
        const pakets = {!! $pakets->map(function($paket) {
            return [
                'id' => $paket->id_paket,
                'nama' => $paket->nama_paket,
                'harga' => $paket->harga_paket,
                'harga_formatted' => 'Rp ' . number_format($paket->harga_paket, 0, ',', '.')
            ];
        })->keyBy('id')->toJson() !!};

        // State untuk quantity paket
        const paketQuantities = {};

        // Initialize quantities
        Object.keys(pakets).forEach(id => {
            paketQuantities[id] = 0;
        });

        // Update tampilan quantity
        function updateQuantityDisplay(paketId) {
            const display = document.querySelector(`.qty-display[data-paket-id="${paketId}"]`);
            if (display) {
                display.textContent = paketQuantities[paketId];
            }
        }

        // Update pesanan list
        function updatePesananList() {
            const pesananList = document.getElementById('pesananList');
            const emptyPesanan = document.getElementById('emptyPesanan');
            let total = 0;
            let hasPesanan = false;

            // Clear current list
            pesananList.innerHTML = '';

            // Add each paket that has quantity > 0
            Object.keys(paketQuantities).forEach(paketId => {
                const qty = paketQuantities[paketId];
                if (qty > 0) {
                    hasPesanan = true;
                    const paket = pakets[paketId];
                    const subtotal = paket.harga * qty;
                    total += subtotal;

                    const pesananItem = document.createElement('div');
                    pesananItem.className = 'flex justify-between items-center';
                    pesananItem.innerHTML = `
                        <div>
                            <span class="font-medium text-gray-800">${paket.nama}</span>
                            <span class="text-sm text-gray-600 ml-2">x${qty}</span>
                        </div>
                        <span class="font-medium text-gray-800">Rp ${new Intl.NumberFormat('id-ID').format(subtotal)}</span>
                    `;
                    pesananList.appendChild(pesananItem);
                }
            });

            // Show empty message if no pesanan
            if (!hasPesanan) {
                pesananList.appendChild(emptyPesanan);
                emptyPesanan.style.display = 'block';
            } else {
                emptyPesanan.style.display = 'none';
            }

            // Update total
            document.getElementById('totalHarga').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        }

        // Event listeners untuk tombol plus/minus
        document.addEventListener('click', function(e) {
            if (e.target.closest('.plus-btn')) {
                const paketId = e.target.closest('.plus-btn').getAttribute('data-paket-id');
                paketQuantities[paketId]++;
                updateQuantityDisplay(paketId);
                updatePesananList();
            }

            if (e.target.closest('.minus-btn')) {
                const paketId = e.target.closest('.minus-btn').getAttribute('data-paket-id');
                if (paketQuantities[paketId] > 0) {
                    paketQuantities[paketId]--;
                    updateQuantityDisplay(paketId);
                    updatePesananList();
                }
            }
        });

        // Prepare form data sebelum submit
        document.getElementById('reservasiForm').addEventListener('submit', function(e) {
            const selectedPakets = [];
            Object.keys(paketQuantities).forEach(paketId => {
                if (paketQuantities[paketId] > 0) {
                    selectedPakets.push({
                        id: paketId,
                        qty: paketQuantities[paketId]
                    });
                }
            });

            // Add hidden inputs for pakets
            selectedPakets.forEach((paket, index) => {
                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = `pakets[${index}][id]`;
                idInput.value = paket.id;
                this.appendChild(idInput);

                const qtyInput = document.createElement('input');
                qtyInput.type = 'hidden';
                qtyInput.name = `pakets[${index}][qty]`;
                qtyInput.value = paket.qty;
                this.appendChild(qtyInput);
            });

            // Validate至少有一个paket被选择
            if (selectedPakets.length === 0) {
                e.preventDefault();
                alert('Pilih minimal 1 paket untuk melakukan reservasi');
            }
        });

        // Initialize
        updatePesananList();
    </script>
</body>
</html>