<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kantin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            /* Very light grey as background */
        }

        .navbar,
        .footer {
            background-color: #ffffff;
            /* White background for elegance */
            border-bottom: 1px solid #e0e0e0;
            /* Light grey border for a clean separation */
        }

        .btn-primary {
            background-color: #4a4a4a;
            /* Dark grey for buttons */
            border-color: #4a4a4a;
        }

        .btn-primary:hover {
            background-color: #333333;
            /* Darker grey on hover */
            border-color: #333333;
        }

        .card {
            background-color: #ffffff;
            /* White cards */
            border: 1px solid #e0e0e0;
            /* Light grey border for definition */
        }

        .text-primary {
            color: #333333;
            /* Dark grey for primary text */
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <div class="navbar shadow-lg fixed top-0 left-0 right-0 z-50">
        <div class="flex-1">
            <a class="btn btn-ghost normal-case text-xl text-primary">E-Kantin</a>
        </div>
        <div class="flex-none gap-2">
            <a href="#features" class="btn btn-ghost text-primary btn-sm">Fitur</a>
            <a href="#about" class="btn btn-ghost text-primary btn-sm">Tentang</a>
            <a href="#contact" class="btn btn-ghost text-primary btn-sm">Kontak</a>
            <a href="<?= base_url('auth/login') ?>" class="btn btn-outline btn-sm mr-2">Login</a>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero min-h-screen bg-white">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <img src="<?= base_url('assets/img/hero2.jpg') ?>" class="max-w-sm rounded-lg shadow-2xl" alt="E-Kantin App Image" />
            <div>
                <h1 class="text-5xl font-bold text-primary">Selamat Datang di E-Kantin SMPN 10 Batam!</h1>
                <p class="py-6 text-primary">Nikmati kemudahan memesan makanan di kantin sekolah dengan aplikasi E-Kantin. Pesan makanan favoritmu langsung dari ponselmu!</p>
                <a href="#features" class="btn btn-primary">Jelajahi Fitur</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold mb-8 text-primary">Fitur Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="card shadow-xl">
                    <div class="card-body">
                        <h3 class="text-2xl font-semibold text-primary">Pesan Online</h3>
                        <p class="text-primary">Kini kamu bisa memesan makanan dari kantin melalui aplikasi, tanpa harus antre!</p>
                    </div>
                </div>
                <div class="card shadow-xl">
                    <div class="card-body">
                        <h3 class="text-2xl font-semibold text-primary">Riwayat Pesanan</h3>
                        <p class="text-primary">Lihat kembali semua pesanan yang pernah kamu buat di kantin sekolah.</p>
                    </div>
                </div>
                <!-- <div class="card shadow-xl">
                    <div class="card-body">
                        <h3 class="text-2xl font-semibold text-primary">Pembayaran Mudah</h3>
                        <p class="text-primary">Pembayaran langsung dari aplikasi, aman dan cepat menggunakan e-wallet.</p>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold mb-8 text-primary">Tentang E-Kantin SMP</h2>
            <p class="text-lg text-primary">E-Kantin SMP adalah aplikasi yang dirancang khusus untuk memudahkan siswa dan guru dalam memesan makanan di kantin sekolah. Dengan E-Kantin, kamu bisa melihat menu, memesan makanan, dan melakukan pembayaran tanpa harus antre.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold mb-8 text-primary">Kontak Kami</h2>
            <p class="text-lg text-primary">Jika ada pertanyaan atau butuh bantuan, jangan ragu untuk menghubungi kami.</p>
            <a href="mailto:info@ekantin.com" class="btn btn-primary mt-4">Email Kami</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer footer-center p-10 text-primary-content bg-white">
        <div class="text-primary">
            <p>&copy; 2024 E-Kantin SMP. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>