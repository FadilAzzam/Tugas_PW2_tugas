<?php
require_once "../dbkoneksi2.php";

// Hapus data jika ada ID yang dikirim via GET
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $dbh->prepare("DELETE FROM paramedik WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: paramedik.php");
    exit;
}

// Ambil semua data paramedik
$list_paramedik = $dbh->query("SELECT * FROM paramedik");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Paramedik</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Daftar Paramedik</h2>

<a href="form_tambah_paramedik.php">+ Tambah Paramedik</a>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Kategori</th>
            <th>Telpon</th>
            <th>Alamat</th>
            <th>Unit Kerja ID</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list_paramedik as $idx => $p) { ?>
        <tr>
            <td><?= $idx + 1 ?></td>
            <td><?= $p['nama'] ?></td>
            <td><?= $p['gender'] ?></td>
            <td><?= $p['tmp_lahir'] ?></td>
            <td><?= $p['tgl_lahir'] ?></td>
            <td><?= $p['kategori'] ?></td>
            <td><?= $p['telpon'] ?></td>
            <td><?= $p['alamat'] ?></td>
            <td><?= $p['unit_kerja_id'] ?></td>
            <td><a href="?delete_id=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
