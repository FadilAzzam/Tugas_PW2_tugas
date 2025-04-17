<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Klinik</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="topbar">
        <div class="logo">🏥 Puskesmas Sehat</div>
        <nav>
            <a href="#">Home</a>
            <a href="#">Tentang</a>
            <a href="#">Kontak</a>
        </nav>
    </header>

    <main class="dashboard">
        <h1>Dashboard Puskesmas</h1>
        <p class="subtext">Kelola data klinik dengan efisien dan mudah.</p>

        <div class="menu-grid">
            <a href="pasien/pasien.php" class="card-menu"><h3>🧍 Pasien</h3></a>
            <a href="paramedik/paramedik.php" class="card-menu"><h3>🩺 Paramedik</h3></a>
            <a href="kelurahan/kelurahan.php" class="card-menu"><h3>🏘️ Kelurahan</h3></a>
            <a href="unit_kerja/unit_kerja.php" class="card-menu"><h3>🏥 Unit Kerja</h3></a>
            <a href="periksa/periksa.php" class="card-menu"><h3>📋 Pemeriksaan</h3></a>
        </div>
    </main>

    <footer class="footer">
        &copy; <?= date("Y") ?> Puskesmas Sehat. All rights reserved.
    </footer>
</body>
</html>
