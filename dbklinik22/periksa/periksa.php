<?php
require_once "../dbkoneksi2.php";

// Hapus data jika ada ID yang dikirim
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $dbh->prepare("DELETE FROM periksa WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: periksa.php");
    exit;
}

$list_periksa = $dbh->query("SELECT * FROM periksa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pemeriksaan Pasien</title>
    <link rel="stylesheet" href="../assets/style.css"> 
</head>
<body>
    <h2>Data Pemeriksaan Pasien</h2>
    <a href="form_tambah_periksa.php">+ Tambah Pemeriksaan</a>
    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Berat (kg)</th>
                <th>Tinggi (cm)</th>
                <th>Tensi</th>
                <th>Keterangan</th>
                <th>ID Pasien</th>
                <th>ID Dokter</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_periksa as $idx => $px): ?>
            <tr>
                <td><?= $idx + 1 ?></td>
                <td><?= $px['tanggal'] ?></td>
                <td><?= $px['berat'] ?></td>
                <td><?= $px['tinggi'] ?></td>
                <td><?= $px['tensi'] ?></td>
                <td><?= $px['keterangan'] ?></td>
                <td><?= $px['pasien_id'] ?></td>
                <td><?= $px['dokter_id'] ?></td>
                <td><a href="?delete_id=<?= $px['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
