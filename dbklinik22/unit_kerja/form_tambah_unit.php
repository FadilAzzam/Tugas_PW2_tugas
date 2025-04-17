<?php
require_once "../dbkoneksi2.php";

// Proses simpan data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];

    $sql = "INSERT INTO unit_kerja (nama) VALUES (?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nama]);

    echo "✅ Data Unit Kerja berhasil ditambahkan!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Tambah Unit Kerja</title>
    <link rel="stylesheet" href="../assets/style.css"> 
</head>
<body>
    <h2>Form Tambah Unit Kerja</h2>
    <form method="POST">
        <label>Nama Unit Kerja: 
            <input type="text" name="nama" required>
        </label><br><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
