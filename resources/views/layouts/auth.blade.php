<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mao Place</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    {{-- Load Tailwind CSS --}}
    @vite('resources/css/app.css')

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    {{-- Tempat isi konten halaman auth --}}
    <main>
        @yield('auth-content')
    </main>

    {{-- Script JS --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>