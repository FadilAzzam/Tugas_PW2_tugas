<?php
require_once "../dbkoneksi2.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];

    $sql = "INSERT INTO kelurahan (nama) VALUES (?)";
    $stmt = $dbh->prepare($sql);

    try {
        $stmt->execute([$nama]);
        echo "<p class='success'>Kelurahan berhasil ditambahkan!</p>";
    } catch (PDOException $e) {
        echo "<p class='error'>Gagal menambahkan kelurahan: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Tambah Kelurahan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Form Tambah Kelurahan</h2>
<form method="POST">
    <label>Nama Kelurahan: <input type="text" name="nama" required></label><br><br>
    <button type="submit">Simpan</button>
</form>

</body>
</html>
