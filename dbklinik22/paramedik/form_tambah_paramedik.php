<?php
require_once "../dbkoneksi2.php";

// Ambil data unit kerja untuk dropdown
$list_unit = $dbh->query("SELECT * FROM unit_kerja");

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $tmp_lahir = $_POST['tmp_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $kategori = $_POST['kategori'];
    $telpon = $_POST['telpon'];
    $alamat = $_POST['alamat'];
    $unit_kerja_id = $_POST['unit_kerja_id'];

    $sql = "INSERT INTO paramedik (nama, gender, tmp_lahir, tgl_lahir, kategori, telpon, alamat, unit_kerja_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nama, $gender, $tmp_lahir, $tgl_lahir, $kategori, $telpon, $alamat, $unit_kerja_id]);

    echo "✅ Data paramedik berhasil ditambahkan!";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Tambah Paramedik</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>


<h2>Form Tambah Paramedik</h2>
<form method="POST">
    <label>Nama: <input type="text" name="nama" required></label><br><br>
    <label>Gender:
        <select name="gender" required>
            <option value="">-- Pilih Gender --</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </label><br><br>
    <label>Tempat Lahir: <input type="text" name="tmp_lahir" required></label><br><br>
    <label>Tanggal Lahir: <input type="date" name="tgl_lahir" required></label><br><br>
    <label>Kategori: <input type="text" name="kategori" required></label><br><br>
    <label>Telepon: <input type="text" name="telpon"></label><br><br>
    <label>Alamat: <textarea name="alamat"></textarea></label><br><br>

    <label>Unit Kerja:
        <select name="unit_kerja_id" required>
            <option value="">-- Pilih Unit Kerja --</option>
            <?php foreach ($list_unit as $uk): ?>
                <option value="<?= $uk['id'] ?>"><?= $uk['nama'] ?></option>
            <?php endforeach; ?>
        </select>
        <a href="../unit_kerja/form_tambah_unit.php" target="_blank">[Tambah Unit Kerja Baru]</a>
    </label><br><br>

    <button type="submit">Simpan</button>
</form>
