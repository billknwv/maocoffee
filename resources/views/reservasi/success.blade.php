<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Berhasil - Mao Place</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
            <!-- Tombol Kembali -->
            <div class="text-left mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors duration-200">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Home
                </a>
            </div>

            <!-- Icon Success -->
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-green-500 text-3xl"></i>
            </div>

            <!-- Judul -->
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Data Telah Terkirim</h1>
            <p class="text-2xl font-semibold text-green-600 mb-6">Terimakasih Telah Melakukan Reservasi</p>

            <!-- Pesan -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                <p class="text-blue-800">
                    Silahkan Melakukan Konfirmasi Ke Admin Mao melalui chat yang telah disediakan
                </p>
            </div>

            <!-- Info Tambahan -->
            <div class="text-sm text-gray-600 space-y-2">
                <p>📞 Hubungi kami: 0812-3456-7890</p>
                <p>💬 WhatsApp: 0812-3456-7890</p>
                <p>📧 Email: admin@maoplace.com</p>
            </div>
        </div>
    </div>
</body>
</html>