<?php
require_once "../dbkoneksi2.php";

// Proses tambah data unit kerja
if (isset($_POST['tambah'])) {
    $nama_unit = $_POST['nama_unit'];
    $dbh->query("INSERT INTO unit_kerja (nama) VALUES ('$nama_unit')");
    header("Location: index.php"); // Refresh halaman setelah penambahan
}

// Proses hapus data unit kerja
if (isset($_GET['hapus'])) {
    $id_unit = $_GET['hapus'];
    $dbh->query("DELETE FROM unit_kerja WHERE id = $id_unit");
    header("Location: index.php"); // Refresh halaman setelah penghapusan
}

$list_unit = $dbh->query("SELECT * FROM unit_kerja");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Unit Kerja</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Daftar Unit Kerja</h2>

    <!-- Link untuk menambah unit kerja -->
    <p><a href="form_tambah_unit.php">Tambah Unit Kerja</a></p>  <!-- Mengarahkan ke halaman tambah unit kerja -->

    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Unit Kerja</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_unit as $idx => $unit): ?>
            <tr>
                <td><?= $idx + 1 ?></td>
                <td><?= $unit['nama'] ?></td>
                <td>
                    <!-- Tombol Hapus -->
                    <a href="?hapus=<?= $unit['id'] ?>" onclick="return confirm('Yakin ingin menghapus unit kerja ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
