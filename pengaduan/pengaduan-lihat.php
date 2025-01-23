<?php
session_start();
require "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    
    // Mengambil data pengaduan termasuk nama pelapor dan NIK
    $sql = "SELECT p.*, m.nama AS nama_pelapor, m.nik AS nik_pelapor 
            FROM pengaduan p
            INNER JOIN masyarakat m ON p.nik = m.nik
            WHERE p.id_pengaduan = ?";
    $row = $koneksi->execute_query($sql, [$id])->fetch_assoc();
    $nik = $row['nik_pelapor'];
    $nama_pelapor = $row['nama_pelapor'];
    $laporan = $row['isi_laporan'];
    $foto = $row['foto'];
    $status = $row['status'];

    // Mengambil data tanggapan termasuk nama petugas
    $sql = "SELECT t.tgl_tanggapan, t.tanggapan, pt.nama_petugas 
            FROM tanggapan t
            LEFT JOIN petugas pt ON t.id_petugas = pt.id_petugas
            WHERE t.id_pengaduan = ?";
    $row = $koneksi->execute_query($sql, [$id])->fetch_assoc();
    $tanggal_tanggapan = $row['tgl_tanggapan'];
    $tanggapan = $row['tanggapan'];
    $nama_petugas = $row['nama_petugas'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lihat Pengaduan</title>
</head>
<body>
    <h1>Lihat Pengaduan</h1>
    <a href="pengaduan.php">Kembali</a>
    <form action="" method="post">
        <div class="form-item">
            <label for="nama_pelapor">Nama Pelapor</label>
            <input type="text" name="nama_pelapor" id="nama_pelapor" value="<?= $nama_pelapor ?>" readonly>
        </div>
        <div class="form-item">
            <label for="nik">NIK Pelapor</label>
            <input type="text" name="nik" id="nik" value="<?= $nik ?>" readonly>
        </div>
        <div class="form-item">
            <label for="laporan">Isi Laporan</label>
            <textarea name="laporan" id="laporan" readonly><?= $laporan ?></textarea>
        </div>
        <div class="form-item">
            <label for="foto">Foto Pendukung</label>
            <img src="../gambar/<?= $foto ?>" alt="" width="250px">
        </div>
        <div class="form-item">
            <label for="tanggal_tanggapan">Tanggal Ditanggapi</label>
            <input type="date" name="tanggal_tanggapan" id="tanggal_tanggapan" value="<?= $tanggal_tanggapan ?>" disabled>
        </div>
        <div class="form-item">
            <label for="nama_petugas">Nama Petugas</label>
            <input type="text" name="nama_petugas" id="nama_petugas" value="<?= $nama_petugas ?>" disabled>
        </div>
        <div class="form-item">
            <label for="tanggapan">Tanggapan</label>
            <textarea name="tanggapan" id="tanggapan" readonly><?= $tanggapan ?></textarea>
        </div>
        <a href="pengaduan.php">Kembali</a>
    </form>
</body>
</html>
