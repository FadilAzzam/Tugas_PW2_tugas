<?php
require_once "../dbkoneksi2.php";

// Ambil data kelurahan untuk dropdown
$list_kelurahan = $dbh->query("SELECT * FROM kelurahan");

// Handle POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $tmp_lahir = $_POST['tmp_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $kelurahan_id = $_POST['kelurahan_id'];

    $sql = "INSERT INTO pasien (kode, nama, gender, tmp_lahir, tgl_lahir, email, alamat, kelurahan_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$kode, $nama, $gender, $tmp_lahir, $tgl_lahir, $email, $alamat, $kelurahan_id]);

    echo "✅ Data pasien berhasil ditambahkan!";
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


<h2>Form Tambah Pasien</h2>
<form method="POST">
    <label>Kode: <input type="text" name="kode" required></label><br><br>
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
    <label>Email: <input type="email" name="email"></label><br><br>
    <label>Alamat: <textarea name="alamat"></textarea></label><br><br>
    <label>Kelurahan:
        <select name="kelurahan_id" required>
            <option value="">-- Pilih Kelurahan --</option>
            <?php foreach ($list_kelurahan as $kel): ?>
                <option value="<?= $kel['id'] ?>"><?= $kel['nama'] ?></option>
            <?php endforeach; ?>
        </select>
        <a href="../kelurahan/form_tambah_kelurahan.php" target="_blank">[Tambah Kelurahan Baru]</a>
    </label><br><br>

    <button type="submit">Simpan</button>
</form>
