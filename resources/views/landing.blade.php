<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TachSavvy Library</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f8;
        }

        header {
            background-color: #27c7ac;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        .nav-buttons a {
            text-decoration: none;
            color: white;
            margin-left: 15px;
            padding: 8px 16px;
            border-radius: 5px;
            background-color: #2326ce;
        }

        .nav-buttons a.register {
            background-color: #fcfffd;
        }

        .hero {
            text-align: center;
            padding: 80px 20px;
            background-color: white;
        }

        .hero h2 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 18px;
            color: #555;
            max-width: 700px;
            margin: auto;
        }

        .about {
            padding: 60px 40px;
            background-color: #f1f5f9;
        }

        .about h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .about p {
            max-width: 800px;
            margin: auto;
            font-size: 16px;
            line-height: 1.7;
            color: #444;
            text-align: center;
        }

        footer {
            background-color: #1e293b;
            color: white;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>TachSavvy Library</h1>
        <div class="nav-buttons">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h2>Selamat Datang di TachSavvy Library</h2>
        <p>
            Perpustakaan modern berbasis teknologi yang menyediakan berbagai koleksi
            buku, jurnal, dan referensi digital untuk mendukung pembelajaran dan
            pengembangan pengetahuan.
        </p>
    </section>

    <!-- About Section -->
    <section class="about">
        <h3>Tentang Perpustakaan</h3>
        <p>
            TachSavvy Library adalah perpustakaan yang menggabungkan dunia literasi
            dan teknologi. Kami berkomitmen untuk memberikan akses informasi yang
            mudah, cepat, dan terorganisir bagi seluruh anggota perpustakaan.
            Dengan sistem digital, pencarian buku dan manajemen peminjaman
            menjadi lebih efisien.
        </p>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 TachSavvy Library. All rights reserved.</p>
    </footer>

</body>
</html>