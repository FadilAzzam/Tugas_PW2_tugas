<?php
require_once "../dbkoneksi2.php";

// Ambil semua kelurahan untuk dropdown
$list_kelurahan = $dbh->query("SELECT * FROM kelurahan")->fetchAll();

// Ambil ID dari URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("❌ ID tidak valid!");
}

$id = $_GET['id'];

// Ambil data pasien berdasarkan ID
$stmt = $dbh->prepare("SELECT * FROM pasien WHERE id = ?");
$stmt->execute([$id]);
$pasien = $stmt->fetch();

if (!$pasien) {
    die("❌ Pasien tidak ditemukan!");
}

// Proses saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode        = $_POST['kode'];
    $nama        = $_POST['nama'];
    $gender      = $_POST['gender'];
    $tmp_lahir   = $_POST['tmp_lahir'];
    $tgl_lahir   = $_POST['tgl_lahir'];
    $email       = $_POST['email'];
    $alamat      = $_POST['alamat'];
    $kelurahan_id = $_POST['kelurahan_id'];

    $sql = "UPDATE pasien SET kode=?, nama=?, gender=?, tmp_lahir=?, tgl_lahir=?, email=?, alamat=?, kelurahan_id=? WHERE id=?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$kode, $nama, $gender, $tmp_lahir, $tgl_lahir, $email, $alamat, $kelurahan_id, $id]);

    echo "<script>alert('✅ Data berhasil diperbarui!'); window.location.href='pasien.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pasien</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Form Ubah Data Pasien</h2>

<form method="POST">
    <label>Kode: <input type="text" name="kode" value="<?= htmlspecialchars($pasien['kode']) ?>" required></label><br><br>
    <label>Nama: <input type="text" name="nama" value="<?= htmlspecialchars($pasien['nama']) ?>" required></label><br><br>
    <label>Gender:
        <select name="gender" required>
            <option value="">-- Pilih Gender --</option>
            <option value="L" <?= $pasien['gender'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
            <option value="P" <?= $pasien['gender'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
        </select>
    </label><br><br>
    <label>Tempat Lahir: <input type="text" name="tmp_lahir" value="<?= htmlspecialchars($pasien['tmp_lahir']) ?>" required></label><br><br>
    <label>Tanggal Lahir: <input type="date" name="tgl_lahir" value="<?= htmlspecialchars($pasien['tgl_lahir']) ?>" required></label><br><br>
    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($pasien['email']) ?>"></label><br><br>
    <label>Alamat: <textarea name="alamat"><?= htmlspecialchars($pasien['alamat']) ?></textarea></label><br><br>
    <label>Kelurahan:
        <select name="kelurahan_id" required>
            <option value="">-- Pilih Kelurahan --</option>
            <?php foreach ($list_kelurahan as $kel): ?>
                <option value="<?= $kel['id'] ?>" <?= $kel['id'] == $pasien['kelurahan_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($kel['nama']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <a href="../kelurahan/form_tambah_kelurahan.php" target="_blank">[Tambah Kelurahan Baru]</a>
    </label><br><br>

    <button type="submit">Simpan Perubahan</button>
</form>

</body>
</html>
