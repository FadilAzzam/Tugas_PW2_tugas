<?php
require_once "../dbkoneksi2.php";

// Hapus data jika ada ID yang dikirim
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $dbh->prepare("DELETE FROM kelurahan WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: kelurahan.php");
    exit;
}

// Ambil data kelurahan
$list_kelurahan = $dbh->query("SELECT * FROM kelurahan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kelurahan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Data Kelurahan</h2>
    <a href="form_tambah_kelurahan.php">+ Tambah Kelurahan</a>
    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelurahan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_kelurahan as $idx => $kel): ?>
            <tr>
                <td><?= $idx + 1 ?></td>
                <td><?= htmlspecialchars($kel['nama']) ?></td>
                <td><a href="?delete_id=<?= $kel['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
