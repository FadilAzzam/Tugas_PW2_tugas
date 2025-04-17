<?php
require_once "../dbkoneksi2.php";

// Proses hapus jika ada ID dikirim via GET
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $dbh->prepare("DELETE FROM pasien WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: pasien.php");
    exit;
}

// Cek apakah ada pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $query = "SELECT * FROM pasien WHERE kode LIKE ? OR nama LIKE ? OR email LIKE ?";
    $stmt = $dbh->prepare($query);
    $searchParam = '%' . $search . '%';
    $stmt->execute([$searchParam, $searchParam, $searchParam]);
    $list_pasien = $stmt->fetchAll();
} else {
    $list_pasien = $dbh->query("SELECT * FROM pasien")->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pasien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .search-form {
            margin-bottom: 15px;
        }

        input[type="text"] {
            padding: 6px;
            width: 250px;
        }

        input[type="submit"] {
            padding: 6px 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        tr:hover {
            background-color: #e6f7ff;
        }

        .button-tambah {
            margin-top: 20px;
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 5px;
            float: right;
        }

        .hapus-link {
            color: red;
            text-decoration: none;
        }

        .hapus-link:hover {
            text-decoration: underline;
        }

        .edit-link {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<h2>Data Pasien</h2>

<form class="search-form" method="get" action="pasien.php">
    <input type="text" name="search" placeholder="Cari kode/nama/email..." value="<?= htmlspecialchars($search) ?>">
    <input type="submit" value="Cari">
</form>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Pasien</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($list_pasien) > 0): ?>
            <?php foreach ($list_pasien as $idx => $pasien): ?>
                <tr>
                    <td><?= $idx + 1 ?></td>
                    <td><?= htmlspecialchars($pasien['kode']) ?></td>
                    <td><?= htmlspecialchars($pasien['nama']) ?></td>
                    <td><?= htmlspecialchars($pasien['gender']) ?></td>
                    <td><?= htmlspecialchars($pasien['email'] ?? '-') ?></td>
                    <td>
                        <a href="form_edit_pasien.php?id=<?= $pasien['id'] ?>" class="edit-link">Ubah</a>
                        <a href="?delete_id=<?= $pasien['id'] ?>" class="hapus-link" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Tidak ada data ditemukan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<a href="form_tambah_pasien.php" class="button-tambah">+ Tambah Pasien</a>

</body>
</html>
