<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAPENDA Kota Pontianak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #eaeaea;
        }
        .navbar .navbar-brand img {
            height: 40px;
        }
        .navbar .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }
        .navbar .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }

        /* Header */
        .header {
            position: relative;
            background: url('https://uptppdptk1-bapenda.kalbarprov.go.id/pub/images/UPTPPD_PTK_WIL_I_20230620111258_picture1.jpg') no-repeat center center/cover;
            height: 350px;
            color: white;
            text-align: center;
        }
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Overlay hitam */
        }
        .header .header-content {
            position: relative;
            z-index: 1;
            padding: 120px 20px;
        }
        .header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .header p {
            font-size: 1.2rem;
        }

        /* Info Section */
        .info-section {
            padding: 40px 20px;
            text-align: center;
        }
        .info-section h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
        .info-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .info-icons .icon-box {
            text-align: center;
            padding: 20px;
            width: 250px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .info-icons .icon-box i {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 10px;
        }

        /* Contact Section */
        .contact-section {
            background-color: #343a40;
            color: #ffffff;
            padding: 40px 20px;
            text-align: center;
        }
        .contact-section a {
            color: #17a2b8;
            text-decoration: underline;
        }
        .contact-section a:hover {
            text-decoration: none;
            color: #13a0b0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="https://4.bp.blogspot.com/-aede0SeUcks/ToCcc4GgMHI/AAAAAAAAALs/ciEVOzdgfTM/s1600/Logo+Kota+Pontianak.png" alt="BAPENDA Logo">
                <span class="ms-2">BAPENDA Kota Pontianak</span>
            </a>
            <div class="ms-auto">
                @if (Auth::check())
                    <p>{{Auth::user()->name}}</p>
                    <a href="/dashboard" class="btn btn-outline-primary">Dashboard</a>
                @else
                    <a href="/login" class="btn btn-outline-primary">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <h1>Jadwal Pertemuan & Konferensi</h1>
            <p>Sistem Pemesanan</p>
            <p>Cara modern untuk mengelola ruang dan jadwal untuk rapat Anda.</p>
        </div>
    </header>

    <!-- Info Section -->
    <section class="info-section">
        <h2>Jadikan Tempat Kerja Anda Lebih Baik</h2>
        <p>Solusi fleksibel untuk optimalisasi proses perusahaan secara menyeluruh</p>
        <div class="info-icons">
            <div class="icon-box">
                <i class="bi bi-calendar"></i>
                <p>Pesan pertemuan rapat Anda dari mana saja Anda berada.</p>
            </div>
            <div class="icon-box">
                <i class="bi bi-building"></i>
                <p>Pesan pertemuan Anda langsung dari pihak manajemen ruangan.</p>
            </div>
            <div class="icon-box">
                <i class="bi bi-clock-history"></i>
                <p>Melihat konfirmasi antrean pesanan Anda dengan efisien.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <footer class="contact-section">
        <div class="container">
            <h4>Kontak Kami</h4>
            <p>Jl. Letnan Jendral Soetoyo, Kelurahan Parit Tokaya, Kec. Pontianak Selatan, Kota Pontianak, Kalimantan Barat 78113</p>
            <p>WhatsApp: 0813-5116-4128 </p>
            <p>Instagram: bappenda.pontianak | Website: <a href="https://www.instagram.com/bapenda.pontianak?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">bappenda.pontianak.go.id</a></p>
            <p>&copy; 2024 BAPENDA Kota Pontianak</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
