<?php
require_once "../dbkoneksi2.php";

// Ambil data pasien dan paramedik (dokter) untuk dropdown
$list_pasien = $dbh->query("SELECT id, nama FROM pasien");
$list_dokter = $dbh->query("SELECT id, nama FROM paramedik");

// Proses form jika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $tensi = $_POST['tensi'];
    $keterangan = $_POST['keterangan'];
    $pasien_id = $_POST['pasien_id'];
    $dokter_id = $_POST['dokter_id'];

    $sql = "INSERT INTO periksa (tanggal, berat, tinggi, tensi, keterangan, pasien_id, dokter_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$tanggal, $berat, $tinggi, $tensi, $keterangan, $pasien_id, $dokter_id]);

    echo "<p class='sukses'>✅ Data periksa berhasil ditambahkan!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Pemeriksaan</title>
    <link rel="stylesheet" href="../assets/style.css"> 
</head>
<body>
    <h2>Form Tambah Pemeriksaan</h2>
    <form method="POST">
        <label>Tanggal: <input type="date" name="tanggal" required></label><br><br>
        <label>Berat (kg): <input type="number" step="0.1" name="berat" required></label><br><br>
        <label>Tinggi (cm): <input type="number" step="0.1" name="tinggi" required></label><br><br>
        <label>Tensi: <input type="text" name="tensi" required></label><br><br>
        <label>Keterangan: <textarea name="keterangan"></textarea></label><br><br>

        <label>Pasien:
            <select name="pasien_id" required>
                <option value="">-- Pilih Pasien --</option>
                <?php foreach ($list_pasien as $ps): ?>
                    <option value="<?= $ps['id'] ?>"><?= $ps['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </label><br><br>

        <label>Dokter:
            <select name="dokter_id" required>
                <option value="">-- Pilih Paramedik --</option>
                <?php foreach ($list_dokter as $dr): ?>
                    <option value="<?= $dr['id'] ?>"><?= $dr['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </label><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
